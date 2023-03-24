import './stripe';

let stripe;
let elements;
let emailAddress = '';

if ($(".stripe").length) {

    const {key} = await fetch('/stripe/fetchStripePublicKey', {
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).then((r) => r.json());

    stripe = Stripe(key);

    initialize();
    checkStatus();
    document
        .querySelector("#payment-form")
        .addEventListener("submit", handleSubmit);

}

async function initialize() {
    emailAddress = $('input[name="email"]').val();
    const {clientSecret} = await fetch("/stripe/createPaymentIntent", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify({amount: parseFloat($('input[name="amount"]').val()) / 2}),
    }).then((r) => r.json());

    elements = stripe.elements({clientSecret});

    const linkAuthenticationElement = elements.create("linkAuthentication", {
        defaultValues: {
            email: emailAddress
        }
    });
    linkAuthenticationElement.mount("#link-authentication-element");

    const paymentElementOptions = {
        layout: "tabs",
    };

    const paymentElement = elements.create("payment", paymentElementOptions);
    paymentElement.mount("#payment-element");
}

async function handleSubmit(e) {
    e.preventDefault();
    setLoading(true);
    const productId = $('input[name="product_id"]').val();
    const quantity = $('input[name="quantity"]').val();
    const amount = $('input[name="amount"]').val();

    const response = await stripe.confirmPayment({
        elements,
        confirmParams: {
            return_url: `http://127.0.0.1:8000/order/checkout?product_id=${productId}&quantity=${quantity}&amount=${amount}&email=${emailAddress}`,
        }
    });

    if (response.error) {
        if (response.type === "card_error" || response.type === "validation_error") {
            showMessage(response.message);
        } else {
            showMessage("An unexpected error occurred.");
        }
    }

    setLoading(false);
}

// Fetches the payment intent status after payment submission
async function checkStatus() {
    const clientSecret = new URLSearchParams(window.location.search).get(
        "payment_intent_client_secret"
    );

    if (!clientSecret) {
        return;
    }

    const {paymentIntent} = await stripe.retrievePaymentIntent(clientSecret);

    switch (paymentIntent.status) {
        case "succeeded":
            showMessage("Payment succeeded!");
            break;
        case "processing":
            showMessage("Your payment is processing.");
            break;
        case "requires_payment_method":
            showMessage("Your payment was not successful, please try again.");
            break;
        default:
            showMessage("Something went wrong.");
            break;
    }
}

// ------- UI helpers -------

function showMessage(messageText) {
    const messageContainer = document.querySelector("#payment-message");

    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;

    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 4000);
}

// Show a spinner on payment submission
function setLoading(isLoading) {
    if (isLoading) {
        // Disable the button and show a spinner
        document.querySelector("#submit").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#button-text").classList.add("hidden");
    } else {
        document.querySelector("#submit").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#button-text").classList.remove("hidden");
    }
}
