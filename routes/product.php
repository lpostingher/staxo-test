<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::prefix('product')->name('product.')->group(function () {
    Route::prefix('{product}')->group(function () {
        Route::get('removeImage', [ProductController::class, 'removeImage'])->name('removeImage');
    });
});
Route::resource('product', ProductController::class);