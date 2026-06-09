<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    public function boot(): void
    {
        Route::get('/redirect', function () {

        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role === 'admin') {
            return redirect('/admin');
        }

        if (Auth::user()->role === 'guru') {
            return redirect('/guru/absensi/create');
        }

        if (Auth::user()->role === 'orangtua') {
            return redirect('/dashboard');
        }

        return redirect('/');
    });
    }
}
