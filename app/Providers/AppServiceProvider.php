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
            Stripe::setApiKey(config('services.stripe.api_key'));
            $client = new Client([
                'base_uri' => config('services.stripe.url'),
                'http_errors' => false,
                'timeout' => 10,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            return new StripeAdapter($client);
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
