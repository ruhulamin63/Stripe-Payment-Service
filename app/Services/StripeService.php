<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createPaymentIntent($amount)
    {
        return PaymentIntent::create([
            'amount' => $amount * 100, // Convert amount to cents
            'currency' => 'usd',
        ]);
    }
}