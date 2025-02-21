<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
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

    /**
     * Display the specified resource.
     */
    // public function show(Wishlist $wishlist)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Wishlist $wishlist)
    // {
    //     //
    // }




    public function index()
    {
        $user = auth()->user();
        $wishlistRooms = Wishlist::where('user_id', $user->id)->with('room')->get();
        $wishlistCount = Wishlist::where('user_id', $user->id)->count();
    
        return view('frontend.wishlist.index', compact('wishlistRooms', 'wishlistCount'));
    }
    



    // public function index()
    // {
    //     // $wishlist = Wishlist::where('user_id', Auth::id())->with('room')->get();
    //     // return view('frontend.wishlist.index', compact('wishlist'));
    //     $user = auth()->user();
    // $wishlistItems = Wishlist::where('user_id', $user->id)->get();
    // return view('frontend.wishlist.index', compact('wishlistItems'));
    // }

    public function addToWishlist(Request $request)
{
    $user = auth()->user();

    // Check if the room is already in wishlist
    if (!Wishlist::where('user_id', $user->id)->where('room_id', $request->room_id)->exists()) {
        Wishlist::create([
            'user_id' => $user->id,
            'room_id' => $request->room_id,
        ]);
    }

    // Update wishlist count in session
    $wishlistCount = Wishlist::where('user_id', $user->id)->count();
    Session::put('wishlist_count', $wishlistCount);

    return back()->with('success', 'Added to wishlist!');
}

public function store(Request $request)
{
    $request->validate(['room_id' => 'required|exists:rooms,id']);

    Wishlist::firstOrCreate([
        'user_id' => Auth::id(),
        'room_id' => $request->room_id,
    ]);

    // Update wishlist count in session
    $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
    Session::put('wishlist_count', $wishlistCount);

    return back()->with('success', 'Room added to wishlist!');
}

public function destroy($id)
{
    $wishlist = Wishlist::where('user_id', Auth::id())->where('room_id', $id)->first();
    
    if ($wishlist) {
        $wishlist->delete();

        // Update wishlist count in session
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        Session::put('wishlist_count', $wishlistCount);

        // Redirect back to the wishlist page with success message
        return redirect()->route('wishlist.index')->with('success', 'Room removed from wishlist!');
    }

    return redirect()->route('wishlist.index')->with('error', 'Room not found in wishlist');
}


public function show($id) {
    $room = Room::findOrFail($id);
    return view('frontend.roomDetails', compact('room'));
}



}


