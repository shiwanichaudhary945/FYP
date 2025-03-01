<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordController extends Controller
{
    // public function showLinkRequestForm()
    // {
    //     return view('frontend.Auth.forgot-password');
    // }

    // public function sendResetLinkEmail(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //     ]);

    //     $response = Password::sendResetLink(
    //         $validated
    //     );

    //     if ($response == Password::RESET_LINK_SENT) {
    //         return back()->with('success', 'Password reset link sent!');
    //     }

    //     return back()->withErrors(['email' => 'Unable to send reset link, try again later.']);
    // }

    // public function showResetForm($token)
    // {
    //     return view('frontend.Auth.reset-password', ['token' => $token]);
    // }

    // public function reset(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|confirmed|min:8',
    //         'token' => 'required',
    //     ]);

    //     $response = Password::reset($validated, function ($user, $password) {
    //         $user->password = Hash::make($password);
    //         $user->save();
    //     });

    //     if ($response == Password::PASSWORD_RESET) {
    //         return redirect()->route('login')->with('success', 'Password has been reset!');
    //     }

    //     return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
    // }


    public function forgotPasswordForm()
    {
        return view("frontend.Auth.forgot-password");
    }
}