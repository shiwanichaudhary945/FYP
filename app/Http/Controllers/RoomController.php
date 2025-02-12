<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Fetch all rooms from the database
    $rooms = Room::all();
    return view('backend.dashboard.table', ['rooms' => $rooms]);

}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("frontend.rooms.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        "room_type" => "required",
        "location" => "required",
        "price" => "required",
        "description" => "required",
        'bedrooms' => 'required|integer|min:1',
        'bathrooms' => 'required|integer|min:1',
        'parking' => 'required|in:Yes,No',
        'furnished' => 'required|in:Yes,No',
        'area' => 'required|numeric|min:1',
        "roomImage" => "required",
        'latitude' => 'required',
        'longitude' => 'required',
        'amenities' => 'nullable|array', // Add this to validate amenities
    ]);

    $room = new Room;
    $room->room_type = $request->room_type;
    $room->price = $request->price;
    $room->location = $request->location;
    $room->latitude = $request->latitude;
    $room->longitude = $request->longitude;
    $room->bedrooms = $request->bedrooms;
    $room->bathrooms = $request->bathrooms;
    $room->parking = $request->parking;
    $room->furnished = $request->furnished;
    $room->area = $request->area;
    $room->description = $request->description;

    // Store amenities as JSON
    if ($request->has('amenities')) {
        $room->amenities = json_encode($request->amenities);
    }

    // $room->features = $request->features;
    $room->user_id = Auth::id();

    if ($request->hasFile('roomImage')) {
        $file = $request->file('roomImage');
        $imageName = time(). $file->getClientOriginalName();
        $file->move(public_path('rooms'), $imageName);
        $room->image = 'rooms/' . $imageName;
    }

    $room->save();

    // Handle additional images upload
    if ($request->hasFile('additional_images')) {
        foreach ($request->file('additional_images') as $file) {
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('rooms'), $imageName);
            $room->images()->create([
                'image_path' => 'rooms/' . $imageName,
            ]);
        }
    }

    return redirect()->route('room.index')->withSuccess("Room created successfully.");
}

    /**
     * Display the specified resource.
     */
    // public function show(Room $room)
    // {


    // }

    public function show($id)
    {
        $room = Room::with('images')->findOrFail($id);
        // dd($room->image);
        // dd($room->image, $room->images);
        return view('frontend.roomDetails', compact('room'));
    }



    public function details()
{
    return view('frontend.roomDetails'); // Replace 'room.details' with your actual Blade view for the details page.
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view("frontend.rooms.edit", ['rooms' => $room]);
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        // Validation
        $request->validate([
            "room_type" => "required",
            "location" => "required",
            "price" => "required|numeric",
            "description" => "required|string",
            'roomImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities' => 'nullable|array',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'parking' => 'required|in:Yes,No',
            'furnished' => 'required|in:Yes,No',
            'area' => 'required|numeric', // Ensure amenities is an array
        ]);

        // Update room details
        $room->room_type = $request->room_type;
        $room->location = $request->location;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->bedrooms = $request->bedrooms;
        $room->bathrooms = $request->bathrooms;
        $room->parking = $request->parking;
        $room->furnished = $request->furnished;
        $room->area = $request->area;

        // Handle amenities update (store as JSON)
        if ($request->has('amenities')) {
            $room->amenities = json_encode($request->amenities); // Store selected amenities as JSON
        }

        // Handle main room image update
        if ($request->hasFile('roomImage')) {
            // Check if the room already has an image and delete it if exists
            if ($room->image && file_exists(public_path($room->image))) {
                unlink(public_path($room->image));  // Delete the old image file
            }

            // Save the new image with a unique name
            $file = $request->file('roomImage');
            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); // Unique name
            $file->move(public_path('rooms'), $imageName);  // Move file to public directory
            $room->image = 'rooms/' . $imageName;  // Update image path in the database
        }

        // Handle additional images (if any)
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $file) {
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();  // Unique name
                $file->move(public_path('rooms'), $imageName);  // Move file to public directory

                // Save the new additional image in the room_images table
                $room->images()->create([
                    'image_path' => 'rooms/' . $imageName,
                ]);
            }
        }

        // Save updated room data
        $room->save();

        return redirect()->route('room.index')->with('success', 'Room updated successfully.');
    }


    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('room.index')->with('success', 'Room deleted successfully.');
    }

    public function search(Request $request)
    {
    $query = Room::query();

    // Apply filters based on input
    if ($request->filled('location') && $request->location !== 'Location') {
        $query->where('location', $request->input('location'));
    }

    if ($request->filled('room_type') && $request->room_type !== 'Room Type') {
        $query->where('room_type', $request->input('room_type'));
    }

    if ($request->filled('price_range') && $request->price_range !== 'Price Range') {
        $priceRange = $request->input('price_range');
        if ($priceRange === 'Under 5000') {
            $query->where('price', '<', 5000);
        } elseif ($priceRange === '5000 - 10000') {
            $query->whereBetween('price', [5000, 10000]);
        } elseif ($priceRange === '10000 - 20000') {
            $query->whereBetween('price', [10000, 20000]);
        } elseif ($priceRange === '20000 - 30000') {
            $query->whereBetween('price', [20000, 30000]);
        } elseif ($priceRange === 'Above 30000') {
            $query->where('price', '>', 30000);
        }
    }

    $rooms = $query->get();

    return view('frontend.rooms.filter', compact('rooms'));
}



public function removeImage($roomId, $imageId)
{
    // Find the room
    $room = Room::findOrFail($roomId);

    // Find the image associated with the room
    $image = $room->images()->findOrFail($imageId);

    // Delete the image file from the server (if it exists)
    if (file_exists(public_path($image->image_path))) {
        unlink(public_path($image->image_path));
    }

    // Delete the image record from the database
    $image->delete();

    // Redirect back with a success message
    return redirect()->route('frontend.rooms.edit', $roomId)->with('success', 'Image removed successfully!');
}


public function postindex()
{
    $rooms = Room::all();  // Fetch all rooms from the database
    // dd($rooms);
    return view('frontend.index', compact('rooms'));  // Pass rooms to the view
}

public function home()
{
    $rooms = Room::all();  // Fetch all rooms
    return view('frontend.home', compact('rooms'));
}

// public function compare(Request $request)
// {
//     $roomIds = $request->input('room_ids');
//     $rooms = Room::whereIn('id', $roomIds)->get();
//     return view('frontend.rooms.compare', compact('rooms'));
// }


}

