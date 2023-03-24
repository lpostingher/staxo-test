<?php

namespace Adapters;

use App\Adapters\StripeAdapter;
use Stripe\PaymentIntent;
use Tests\TestCase;

/**
 * Class test for app/Adapters/StripeAdapter.php
 *
 * @property StripeAdapter $instance
 */
class StripeAdapterTest extends TestCase
{
    /**
     * @test
     */
    public function testCreatePaymentIntent(): void
    {
        $response = $this->instance->createPaymentIntent(100.50);
        $this->assertInstanceOf(PaymentIntent::class, $response);
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->setInstance();
    }

    /**
     * Set test's instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new StripeAdapter();
    }
}
