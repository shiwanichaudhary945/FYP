<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

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
    // public function store(Request $request)
    // {
    //     //
    // }

    public function store(Request $request, $roomId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'checkin_date' => 'required|date',
            'occupants' => 'required|integer|min:1|max:10',
            'payment_method' => 'required|string',
        ]);

        Booking::create([

            'room_id' => $roomId,
            'user_id' => auth()->id(), // Add this
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'checkin_date' => $request->checkin_date,
            'occupants' => $request->occupants,
            'payment_method' => $request->payment_method,
            'status' => 'pending' // Default status

        ]);

        return redirect()->back()->with('success', 'Room booked successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }


    // View all bookings
public function index() {
    $bookings = auth()->user()->bookings()->with('room')->get();
    return view('frontend.rooms.show', compact('bookings'));
}

// Cancel booking
public function cancel($id) {
    $booking = Booking::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    if ($booking->status === 'pending') {
        $booking->status = 'canceled';
        $booking->save();
    }
    return redirect()->back()->with('success', 'Booking canceled successfully!');
}

}
