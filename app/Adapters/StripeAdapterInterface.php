<?php

namespace App\Adapters;

/**
 * Stripe Adapter
 */
interface StripeAdapterInterface
{
    /**
     * Create payment intent
     *
     * @param int $amount
     * @return array
     */
    public function createPaymentIntent(float $amount): array;
}
