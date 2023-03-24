<?php

namespace App\Adapters;

use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
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
    public function createPaymentIntent(float $amount): PaymentIntent
    {
        try {
            return PaymentIntent::create([
                'amount' => $amount * 100,
                'currency' => 'usd',
            ]);
        } catch (ApiErrorException $e) {
            Log::error($e->getMessage());
        }
        return new PaymentIntent();
    }

    public function confirmPaymentIntent(PaymentIntent $paymentIntent, PaymentMethod $paymentMethod): PaymentIntent
    {
        if (! $paymentIntent->id) {
            return new PaymentIntent();
        }

        try {
            return $paymentIntent->confirm(['payment_method' => $paymentMethod->id]);
        } catch (ApiErrorException $e) {
            Log::error($e->getMessage());
        }

        return new PaymentIntent();
    }

    public function getPaymentMethod(): PaymentMethod
    {
        $method = PaymentMethod::all()->first();
        if (! $method) {
            $method = PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'number' => '4242424242424242',
                    'exp_month' => 8,
                    'exp_year' => 2050,
                    'cvc' => '314',
                ],
            ]);
        }
        return $method;
    }
}
