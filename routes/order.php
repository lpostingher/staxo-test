<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('order')->name('order.')->group(function () {
    Route::post('create', [OrderController::class, 'create'])->name('create');
    Route::post('createPaymentIntent', [OrderController::class, 'createPaymentIntent'])
        ->name('createPaymentIntent');
    Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('finishCheckout', [OrderController::class, 'finishCheckout'])->name('finishCheckout');
});
