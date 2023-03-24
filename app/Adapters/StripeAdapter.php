<?php

namespace App\Adapters;

use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

/**
 * @inheritDoc
 */
class StripeAdapter implements StripeAdapterInterface
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.api_secret_key'));
    }

    /**
     * @inheritDoc
     */
    public function createPaymentIntent(float $amount): array
    {
        try {
            $intent = PaymentIntent::create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                "payment_method_types" => [
                    "card"
                ],
            ]);
        } catch (ApiErrorException $e) {
            return ['error' => $e->getMessage()];
        }

        return [
            'clientSecret' => $intent->client_secret,
        ];
    }
}
