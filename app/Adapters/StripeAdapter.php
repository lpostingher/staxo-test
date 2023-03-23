<?php

namespace App\Adapters;

use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;

/**
 * Stripe Adapter
 */
class StripeAdapter
{
    /**
     * Create payment intent
     *
     * @param int $amount
     * @return array
     */
    public function createPaymentIntent(int $amount): array
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
