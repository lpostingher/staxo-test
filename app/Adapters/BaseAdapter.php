<?php

namespace App\Adapters;

use GuzzleHttp\Client;

/**
 * Base Adapter
 */
class BaseAdapter
{
    /**
     * @param Client $client
     */
    public function __construct(
        protected readonly Client $client)
    {
    }
}
