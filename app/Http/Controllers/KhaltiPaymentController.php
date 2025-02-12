<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KhaltiPaymentController extends Controller
{
    public function verify(Request $request)
    {
        $token = $request->input('token');
        $amount = $request->input('amount');

        $response = Http::withHeaders([
            'Authorization' => 'Key ' . env('KHALTI_SECRET_KEY'),
        ])->post('https://khalti.com/api/v2/payment/verify/', [
            'token' => $token,
            'amount' => $amount,
        ]);

        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'Payment Successful!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Payment Failed!'], 400);
        }
    }
}




