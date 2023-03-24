<?php

namespace App\Services;

use App\Models\Order;

/**
 * Order Service Interface
 */
interface OrderServiceInterface
{

    /**
     * Handle checkout
     *
     * @param array $input
     * @return Order
     */
    public function checkout(array $input): Order;
}
