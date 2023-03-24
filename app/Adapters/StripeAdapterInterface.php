<?php

namespace App\Adapters;

use Stripe\PaymentIntent;
use Stripe\PaymentMethod;

/**
 * Stripe Adapter
 */
interface StripeAdapterInterface
{
    /**
     * Create payment intent
     *
     * @param float $amount
     * @return PaymentIntent
     */
    public function createPaymentIntent(float $amount): PaymentIntent;

    /**
     * Confirm payment intent
     *
     * @param PaymentIntent $paymentIntent
     * @return array
     */
    public function confirmPaymentIntent(PaymentIntent $paymentIntent, PaymentMethod $paymentMethod): PaymentIntent;

    /**
     * Get payment method
     *
     * @return PaymentMethod
     */
    public function getPaymentMethod(): PaymentMethod;
}
