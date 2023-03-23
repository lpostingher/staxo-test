<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function checkout(array $input)
    {
        Order::factory()->create([
            'product_id' => decrypt($input['product_id']),
            'quantity' => $input['quantity'],
            'amount' => $input['amount'],
            'email' => $input['email']
        ]);
    }
}
