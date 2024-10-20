<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StripeService;
use App\Repositories\PaymentRepositoryInterface;

class StripePaymentController extends Controller
{
    protected $stripeService;
    protected $paymentRepository;

    public function __construct(StripeService $stripeService, PaymentRepositoryInterface $paymentRepository)
    {
        $this->stripeService = $stripeService;
        $this->paymentRepository = $paymentRepository;
    }

    public function index()
    {
        return view('payment');
    }

    public function createPaymentIntent(Request $request)
    {
        $amount = $request->input('amount');
        $intent = $this->stripeService->createPaymentIntent($amount);

        $this->paymentRepository->storePayment([
            'payment_intent_id' => $intent->id,
            'amount' => $amount,
            'status' => $intent->status,
        ]);

        return response()->json([
            'clientSecret' => $intent->client_secret,
        ]);
    }
}
