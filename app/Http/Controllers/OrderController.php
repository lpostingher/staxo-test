<?php

namespace App\Http\Controllers;

use App\Events\CheckoutFinished;
use App\Facades\StripeFacade;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Order handler
 */
class OrderController extends Controller
{
    public function __construct(
        private readonly ProductService $productService,
        private readonly OrderService   $orderService
    )
    {
    }

    /**
     * Create order
     * @param CreateOrderRequest $request
     * @return View
     */
    public function create(CreateOrderRequest $request): View
    {
        $product = $this->productService->getById($request->product_id);
        return view('order.create', [
            'product' => $product,
            'quantity' => $request->quantity,
            'amount' => $request->quantity * $product->price,
            'email' => $request->email
        ]);
    }

    /**
     * Store order
     *
     * @param StoreOrderRequest $request
     * @return void
     */
    public function store(StoreOrderRequest $request)
    {

    }

    /**
     * Checkout order
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function checkout(Request $request): RedirectResponse
    {
        $order = $this->orderService->checkout($request->query());
        CheckoutFinished::dispatch($order);

        return redirect()->route('order.finishCheckout')->with('flash_message', [
            'status' => 'success',
            'message' => 'Your order was finished successfully! Please, check your e-mail.',
        ]);
    }

    /**
     * @return View
     */
    public function finishCheckout(): View
    {
        return view('order.finishCheckout');
    }

    public function createPaymentIntent(Request $request)
    {
        $response = StripeFacade::createPaymentIntent($request->amount);
        return response()->json($response);
    }
}
