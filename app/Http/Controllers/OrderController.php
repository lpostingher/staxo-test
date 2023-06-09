<?php

namespace App\Http\Controllers;

use App\Events\CheckoutFinished;
use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderService;
use App\Services\OrderServiceInterface;
use App\Services\ProductService;
use App\Services\ProductServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Order handler
 */
class OrderController extends Controller
{
    /**
     * @param ProductService $productService
     * @param OrderService $orderService
     */
    public function __construct(
        private readonly ProductServiceInterface $productService,
        private readonly OrderServiceInterface   $orderService,
    ) {
    }

    /**
     * Create order
     *
     * @param CreateOrderRequest $request
     *
     * @return View
     */
    public function create(CreateOrderRequest $request): View
    {
        $product = $this->productService->getById($request->product_id);
        return view('order.create', [
            'product' => $product,
            'quantity' => $request->quantity,
            'amount' => $request->quantity * $product->price,
            'email' => $request->email,
            'redirectUrl' => $this->buildRedirectUrl(
                encrypt($product->id),
                $request->quantity,
                $request->quantity * $product->price,
                $request->email
            ),
        ]);
    }

    /**
     * Checkout order
     *
     * @param Request $request
     *
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

    /**
     * Build redirect url fot automated payments
     *
     * @param string $productId
     * @param int $quantity
     * @param float $amount
     * @param string $email
     *
     * @return string
     */
    private function buildRedirectUrl(string $productId, int $quantity, float $amount, string $email): string
    {
        $query = [
          'product_id' => $productId,
          'quantity' => $quantity,
          'amount' => $amount,
          'email' => $email
        ];

        return route('order.checkout', $query);
    }
}
