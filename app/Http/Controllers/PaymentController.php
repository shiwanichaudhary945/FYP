<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function verify(Request $request)
    {
        $token = $request->token;
        $amount = $request->amount; // Amount in paisa
        $roomId = $request->room_id;

        // Make a request to Khalti for verification
        $response = Http::withHeaders([
            'Authorization' => 'Key ' . config('services.khalti.secret_key'),
        ])->post('https://khalti.com/api/v2/payment/verify/', [
            'token' => $token,
            'amount' => $amount,
        ]);

        $data = $response->json();

        if (isset($data['idx'])) {
            // Payment is successful, save booking
            Booking::create([
                'room_id' => $roomId,
                'user_id' => auth()->id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'checkin_date' => $request->checkin_date,
                'occupants' => $request->occupants,
                'payment_method' => 'khalti',
                'status' => 'confirmed',
                'payment_token' => $token, // Save Khalti transaction ID
            ]);

            return response()->json(['success' => true, 'message' => 'Payment verified, booking confirmed!']);
        }

        return response()->json(['success' => false, 'message' => 'Payment verification failed.']);
    }
}
