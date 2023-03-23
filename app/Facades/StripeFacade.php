<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Stripe Facade
 */
class StripeFacade extends Facade
{
    /**
     * Get Facade Accessor
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'stripe';
    }

}
