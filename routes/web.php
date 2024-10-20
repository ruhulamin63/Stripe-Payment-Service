<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payments\StripePaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment', [StripePaymentController::class, 'index']);

Route::post('/create-payment-intent', [StripePaymentController::class, 'createPaymentIntent']);
