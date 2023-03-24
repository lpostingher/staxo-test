<?php

namespace Events;

use App\Events\CheckoutFinished;
use App\Models\Order;
use Illuminate\Broadcasting\PrivateChannel;
use Tests\TestCase;

/**
 * Class test for App\Events\CheckoutFinished
 *
 * @property CheckoutFinished $instance
 */
class CheckoutFinishedTest extends TestCase
{
    /**
     * @inheritDoc
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
        $order = new Order();
        $this->instance = new CheckoutFinished($order);
    }

    /**
     * @test
     */
    public function testBroadcastOn()
    {
        $result = $this->instance->broadcastOn();
        $this->assertIsArray($result);
        $this->assertInstanceOf(PrivateChannel::class, $result[0]);
    }
}
