<?php

namespace Http\Controllers;

use App\Mail\FinishCheckoutMail;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    public function testCreate(): void
    {
        $payload = [
            'product_id' => encrypt(Product::factory()->create()->id),
            'quantity' => 1,
            'email' => 'email@email.com'
        ];
        $this->post(route('order.create'), $payload)
            ->assertSuccessful()
            ->assertViewIs('order.create')
            ->assertViewHasAll(['product', 'quantity', 'amount', 'email']);
    }

    public function testCreateFail(): void
    {
        $payload = [];
        $this->post(route('order.create'), $payload)
            ->assertRedirect()
            ->assertSessionHasErrors(['product_id', 'quantity', 'email']);
    }

    public function testCheckout(): void
    {
        $query = [
            'product_id' => encrypt(Product::factory()->create()->id),
            'quantity' => 1,
            'amount' => 100,
            'email' => 'email@email.com'
        ];
        $this->get(route('order.checkout', $query))
            ->assertRedirect(route('order.finishCheckout'))
            ->assertSessionHas('flash_message', [
                'status' => 'success',
                'message' => 'Your order was finished successfully! Please, check your e-mail.',
            ]);
        Mail::assertQueued(FinishCheckoutMail::class);
    }

    public function testFinishCheckout(): void
    {
        $this->get(route('order.finishCheckout'))
            ->assertSuccessful()
            ->assertViewIs('order.finishCheckout');
    }

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
    }
}
