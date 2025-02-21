<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Auth::routes(['verify' => true]);


// Auth Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'loginUser'])->name('loginUser');
Route::post('/registerUser', [AuthController::class, 'registerUser'])->name('registerUser');

Route::post('/logout', [AuthController::class, 'logoutHome'])->name('logout.home');


// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout')->middleware('auth');



// Logout from the User Dashboard (Redirect to Landing Page)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Logout from the Homepage (Redirect to Homepage)
Route::post('/logout-home', [AuthController::class, 'logoutHome'])->name('logout.home')->middleware('auth');


// Dashboard Route with Role-Based Logic
// Route::get('/dashboard', [RoleController::class, 'redirectToDashboard'])->middleware('auth')->name('dashboard');

// landing page Route
// Route::get('/', function () {
//     return view('frontend.index');
// })->name('home');

// Route::get('/home', [UserController::class, 'home'])->name('homepage'); // Homepage after login
Route::get('/profile', [UserController::class, 'profile'])->name('profile'); // User profile

// Room Routes (Grouped with Middleware and Prefix)
Route::middleware(['auth'])->prefix('room')->group(function () {
    Route::get('/', [RoomController::class, 'index'])->name('room.index');
    Route::get('/create', [RoomController::class, 'create'])->name('frontend.rooms.create');
    Route::post('/', [RoomController::class, 'store'])->name('frontend.rooms.store');
    Route::get('/{id}/edit', [RoomController::class, 'edit'])->name('frontend.rooms.edit');
    Route::put('/{id}', [RoomController::class, 'update'])->name('frontend.rooms.update');
    Route::delete('/{id}', [RoomController::class, 'destroy'])->name('frontend.rooms.destroy');

    // Filter and Details Routes
    Route::get('/search', [RoomController::class, 'search'])->name('rooms.search');
    Route::get('/details', [RoomController::class, 'details'])->name('room.details');


});

// Landlord Routes (Grouped with Middleware and Prefix)
Route::middleware(['auth'])->prefix('landlord')->group(function () {
    Route::get('/', [LandlordController::class, 'index'])->name('landlord.index');
    Route::get('/create', [LandlordController::class, 'create'])->name('frontend.landlord.create');
    Route::post('/', [LandlordController::class, 'store'])->name('frontend.landlord.store');
    Route::get('/{id}/edit', [LandlordController::class, 'edit'])->name('frontend.landlord.edit');
    Route::put('/{id}', [LandlordController::class, 'update'])->name('frontend.landlord.update');
    Route::delete('/{id}', [LandlordController::class, 'destroy'])->name('frontend.landlord.destroy');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('backend.dashboard.app');  // Admin dashboard
    })->name('admin.dashboard');

    Route::get('/landlord/dashboard', function () {
        return view('backend.dashboard.app');  // Landlord dashboard
    })->name('landlord.dashboard');

    // Route::get('/homepage', function () {
    //     return view('frontend.home');  // Normal user homepage
    // })->name('user.dashboard');
});

Route::get('rooms/{roomId}/remove-image/{imageId}', [RoomController::class, 'removeImage'])->name('frontend.rooms.removeImage');

// Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('frontend.rooms.show');

Route::get('/', [RoomController::class, 'postindex'])->name('landing');
Route::get('/home', [RoomController::class, 'home'])->name('homepage');

Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('room.details');

// Route::get('/compare-rooms', [RoomController::class, 'compare'])->name('rooms.compare');


Route::get('/email/verify', function () {
    return view('frontend.Auth.verify');
})->middleware('auth')->name('verification.notice');

use App\Http\Controllers\ReviewController;

// Display user reviews in dashboard
Route::get('/user/reviews', [ReviewController::class, 'userReviews'])->name('user.reviews');

Route::post('/reviews/{room}', [ReviewController::class, 'store'])->name('reviews.store');

use App\Http\Controllers\BookingController;

Route::post('/rooms/{id}/book', [BookingController::class, 'store'])->name('bookings.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/cancel/{id}', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

Route::get('/user/dashboard', [profileController::class, 'postindex'])->name('userDash');
use App\Http\Controllers\WishlistController;

Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'destroy'])->name('wishlist.remove');
});


use App\Http\Controllers\PaymentController;

Route::post('/khalti-verify', [PaymentController::class, 'verify'])->name('khalti.verify');


// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;

// Route::post('/khalti/verify', function (Request $request) {
//     $token = $request->input('token');
//     $amount = $request->input('amount');

//     $response = Http::withHeaders([
//         'Authorization' => 'Key ' . env('KHALTI_SECRET_KEY')
//     ])->post('https://khalti.com/api/v2/payment/verify/', [
//         'token' => $token,
//         'amount' => $amount
//     ]);
    
//     if ($response->successful()) {
//         // Update the booking to confirmed status
//         Booking::where('room_id', $roomId)->update(['status' => 'confirmed']);
//         return response()->json(['success' => true]);
//     }
    

//     return response()->json(['success' => false], 400);
// })->name('khalti.verify');

Route::get('/booking/success', function () {
    return view('khalti.booking_success'); // Create a Blade file for success message
})->name('booking.success');




// Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
// Route::post('/compare', [RoomController::class, 'compare'])->name('rooms.compare');


Route::get('/compare-rooms', [RoomController::class, 'compare'])->name('rooms.compare');


use App\Http\Controllers\PasswordController;
// Show the form to request a password reset link
Route::get('forgot-password', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Send the password reset link to the user's email
Route::post('forgot-password', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset the user's password
Route::get('reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [PasswordController::class, 'reset'])->name('password.update');
