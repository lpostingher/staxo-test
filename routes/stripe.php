<?php

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::prefix('stripe')->name('stripe.')->group(function () {
    Route::get('fetchStripePublicKey', [StripeController::class, 'fetchStripePublicKey'])
        ->name('fetchStripePublicKey');
    Route::post('createPaymentIntent', [StripeController::class, 'createPaymentIntent'])
        ->name('createPaymentIntent');
});
