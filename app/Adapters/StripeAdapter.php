<?php

namespace App\Adapters;

use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\PaymentLink;
use Stripe\Price;

/**
 * Stripe Adapter
 */
class StripeAdapter extends BaseAdapter
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

    public function getPaymentIntent(string $intentId)
    {
//        $result = PaymentIntent::retrieve($intentId);

//        return PaymentLink::create([
//
//        ]);
        return PaymentIntent::retrieve('pi_3MouvPFVQurkWp3C0ryIi0JF');
    }
}
