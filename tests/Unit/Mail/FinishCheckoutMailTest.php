<?php

namespace Mail;

use App\Mail\FinishCheckoutMail;
use App\Models\Order;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Tests\TestCase;

/**
 * Class test for app/Mail/FinishCheckoutMail.php
 *
 * @property FinishCheckoutMail $instance
 */
class FinishCheckoutMailTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->setInstance();
    }

    private function setInstance(): void
    {
        $this->instance = new FinishCheckoutMail(
            new Order()
        );
    }

    public function testContent()
    {
        $content = $this->instance->content();
        $this->assertInstanceOf(Content::class, $content);
        $this->assertEquals('mail.finishCheckout', $content->view);
        $this->assertArrayHasKey('order', $content->with);
        $this->assertArrayHasKey('product', $content->with);
        $this->assertEquals([
            'order' => $this->instance->order,
            'product' => $this->instance->order->product
        ], $content->with);
    }

    public function testAttachments()
    {
        $this->assertEmpty($this->instance->attachments());
    }

    public function testEnvelope()
    {
        $envelope = $this->instance->envelope();
        $this->assertInstanceOf(Envelope::class, $envelope);
        $this->assertEquals('Order status', $envelope->subject);
    }
}
