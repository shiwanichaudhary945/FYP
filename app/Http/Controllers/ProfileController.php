<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class ProfileController extends Controller
{
    // Show the profile page
    public function index()
    {
        // Return the profile view with user data
        return view('frontend.Tenant.profile', [
            'user' => Auth::user()
        ]);
    }

    public function postindex()
    {
        // Get all users, excluding the logged-in user
        $users = User::all(); // You can filter this query as needed, e.g., `->where('role_id', 2)` or whatever suits your logic

        // Return the dashboard view with the users
        return view('frontend.Tenant.dashboard', [
            'users' => $users // Pass the users to the view
        ]);
    }



    public function update(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',         // Name is required, must be a string, and max 255 characters
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(), // Email is required, valid, and unique
            'password' => 'nullable|string|min:8',       // Password is optional, must be a string, and at least 8 characters if provided
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update user details
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Only update the password if it is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Save the updated user data
        $user->save();

        // Redirect to the profile page with a success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }


}


