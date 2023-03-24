<?php

namespace App\Services;

use App\Models\Order;

/**
 * @inheritDoc
 */
class OrderService implements OrderServiceInterface
{

    /**
     * @inheritDoc
     */
    public function checkout(array $input): Order
    {
        return Order::factory()->create([
            'product_id' => decrypt($input['product_id']),
            'quantity' => $input['quantity'],
            'amount' => $input['amount'],
            'email' => $input['email']
        ]);
    }
}
