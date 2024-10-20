<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment', [PaymentController::class, 'index']);

//used service pattern to create payment intent
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);
