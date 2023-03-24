<?php

namespace App\Http\Controllers;

use App\Adapters\StripeAdapterInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    /**
     * @param StripeAdapterInterface $stripeAdapter
     */
    public function __construct(
        private readonly StripeAdapterInterface $stripeAdapter,
    )
    {
    }

    public function fetchStripePublicKey(): array
    {
        return [
            'key' => config('services.stripe.api_key')
        ];
    }

    /**
     * Create payment intent
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createPaymentIntent(Request $request): JsonResponse
    {
        $response = $this->stripeAdapter->createPaymentIntent($request->amount);
        return response()->json($response);
    }
}
