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


    // public function forgotPasswordForm()
    // {
    //     return view("frontend.Auth.forgot-password");
    // }


    public function forgetPassword()
{
    return view('frontend.Auth.forgot-password');

}
public function sendResetLink(Request $request)
{
    // Validate the email
    $request->validate([
        'email' => 'required|email|exists:users,email', // Ensure the email exists in the 'users' table
    ]);

    // Generate a token
    $token = Str::random(60);

    // Insert the token and email into the password_resets table
    DB::table('password_resets')->where('email', $request->email)->delete();
    DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => now(), // Ensure this function is used with parentheses
    ]);

    // Send Email Here
    $user = User::where('email', $request->email)->first();

    $formData = [
        'token' => $token,
        'user' => $user,
        'mailSubject' => 'You have requested to reset your password', // Add a comma here
    ];

    Mail::to($request->email)->send(new ResetPassword($formData));

    return redirect()->route('Account.signin')->with('success', 'Please check your inbox to reset your password');
}

public function showResetForm($token)
{
    // Pass the token to the view as part of the formData
    $tokenExist =DB::table('password_resets')->where('token', $token)->first();
    if($tokenExist==null){
        return redirect()->route('Account.forgetPassword')->with('error','Invalid request');
    }
 return view('frontend.Account.reset-Password', ['token' => $token]);
}

public function processResetPassword(Request $request)
{
    // Get token from the request
    $token = $request->token;

    // Fetch the password reset record by token
    $tokenObj = DB::table('password_resets')->where('token', $token)->first();

    if ($tokenObj === null) {
        return redirect()->route('Account.forgetPassword')->with('error', 'Invalid or expired reset link.');
    }

    // Fetch the user associated with the email
    $user = User::where('email', $tokenObj->email)->first();

    if (!$user) {
        return redirect()->route('Account.forgetPassword')->with('error', 'User not found.');
    }

    // Validate the input fields
    $request->validate([
        'password' => 'required|min:5',
        'password_confirmation' => 'required|same:password',
    ]);

    // Update the user's password
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    // Delete the reset token record
    DB::table('password_resets')->where('email', $user->email)->delete();

    // Redirect with success message
    return redirect()->route('Account.signin')->with('success', 'Your password has been reset successfully. You can now log in.');
}
}
