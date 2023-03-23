<?php

namespace App\Providers;

use App\Adapters\StripeAdapter;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Stripe\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('stripe', function () {
            Stripe::setApiKey(config('services.stripe.api_secret_key'));

            return new StripeAdapter();
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
