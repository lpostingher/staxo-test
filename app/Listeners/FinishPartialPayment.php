<?php

namespace App\Listeners;

use App\Adapters\StripeAdapterInterface;
use App\Events\CheckoutFinished;
use App\Mail\FinishPartialPaymentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentIntent;

class FinishPartialPayment implements ShouldQueue
{
    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 300;

    /**
     * Create the event listener.
     */
    public function __construct(
        private StripeAdapterInterface $stripeAdapter
    ) {
    }

    /**
     * Handle the event.
     */
    public function handle(CheckoutFinished $event): void
    {
        if ($event->order->is_finished) {
            return;
        }

        $intent = $this->stripeAdapter->createPaymentIntent($event->order->balance);
        $method = $this->stripeAdapter->getPaymentMethod();
        $confirmation = $this->stripeAdapter->confirmPaymentIntent($intent, $method);

        if ($confirmation->status === PaymentIntent::STATUS_SUCCEEDED) {
            $event->order->update(['amount_received' => $event->order->amount]);
            Mail::to($event->order->email)->queue(new FinishPartialPaymentMail($event->order));
        }
    }
}
