<?php

namespace App\Http\Controllers;

use App\Services\StripeService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService){
        $this->stripeService = $stripeService;
    }

    public function index(){
        return view('payment');
    }

    public function createPaymentIntent(Request $request){        
        $amount = $request->input('amount'); // Get amount from request
        $intent = $this->stripeService->createPaymentIntent($amount);

        return response()->json([
            'clientSecret' => $intent->client_secret,
        ]);
    }
}