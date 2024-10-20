<?php

namespace App\Repositories;
use App\Models\Payment;

class StripeRepository implements PaymentRepositoryInterface
{
    public function storePayment($paymentData)
    {
        return Payment::create($paymentData);
    }
}