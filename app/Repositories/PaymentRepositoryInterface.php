<?php

namespace App\Repositories;

interface PaymentRepositoryInterface
{
    public function storePayment($paymentData);
}
