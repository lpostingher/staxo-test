<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function fetchStripePublicKey(): array
    {
        return [
            'key' => config('services.stripe.api_key')
        ];
    }
}
