<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     //
    // }

    public function boot()
{
    View::composer('*', function ($view) {
        if (Auth::check()) {
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
            session(['wishlist_count' => $wishlistCount]);
        }
    });
    
}
}
