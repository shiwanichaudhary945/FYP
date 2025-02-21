<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show the login form
    public function login()
    {
        return view('frontend.Auth.login');
    }

    // Show the registration form
    public function register()
    {
        return view('frontend.Auth.register');
    }

    // Handle the user registration
    public function registerUser(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user record in the database
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

         // Send the email verification link
    $user->sendEmailVerificationNotification(); // Now $user is defined

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    // Handle the user login
    public function loginUser(Request $request)
{
    // Validate the incoming login data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.email' => 'Please enter a valid email address.',
        'email.required' => 'Email is required.',
        'password.required' => 'Password is required.'
    ]);

    // Check if the email exists in the database
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'No account found with this email.'])->withInput();
    }

    // Attempt to authenticate the user
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Redirect based on the user role
        if ($user->role_id == 2) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role_id == 3) {
            return redirect()->route('landlord.dashboard');
        } else {
            return redirect()->route('homepage');  // Normal user homepage
        }
    }

    // Return back with a different message if the password is incorrect
    return back()->withErrors(['password' => 'Incorrect password.'])->withInput();
}

    // Logout the user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to the landing page
    }


    public function logoutHome(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home'); // Redirect to the landing page
    }

    
}
