<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function home()
    {
        $user = Auth::user();  // Get the authenticated user
        return view('frontend.home', compact('user'));  // Pass the user to the view

        return redirect()->route('login'); // Redirect to login if not authenticated
    }

    public function profile()
    {
        return view('profile', ['user' => Auth::user()]);
    }
}
