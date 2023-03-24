<?php

namespace Http\Controllers;

use Tests\TestCase;

class StripeControllerTest extends TestCase
{

    public function testCreatePaymentIntent()
    {
        $payload = [
            'amount' => 100.00
        ];
        $this->post(route('stripe.createPaymentIntent'), $payload)
            ->assertSuccessful()
            ->assertJsonStructure(['clientSecret']);
    }

    public function testCreatePaymentIntentFail()
    {
        $payload = [];
        $this->post(route('stripe.createPaymentIntent'), $payload)
            ->assertRedirect()
            ->assertSessionHasErrors(['amount']);
    }

    public function testFetchStripePublicKey()
    {
        $this->get(route('stripe.fetchStripePublicKey'))
            ->assertSuccessful()
            ->assertJson(['key' => config('services.stripe.api_key')]);
    }
}
