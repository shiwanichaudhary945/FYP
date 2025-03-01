<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
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
    // public function store(Request $request)
    // {

    // }

    public function store(Request $request, $room_id) {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Check if the user has already reviewed this room
        $existingReview = Review::where('user_id', auth()->id())
                                ->where('room_id', $room_id)
                                ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this room.');
        }

        // Create the new review
        Review::create([
            'user_id' => auth()->id(),
            'room_id' => $room_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }

    public function userReviews()
    {
        // Fetch all reviews by the logged-in user
        $reviews = Review::where('user_id', auth()->id())->get();

        // Pass reviews to the view
        return view('frontend.rooms.review', compact('reviews'));
    }

}
