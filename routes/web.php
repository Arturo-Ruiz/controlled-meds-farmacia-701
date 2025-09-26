<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;





Route::middleware('guest')->group(function () {
    Route::redirect('/', 'login', 301);

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login-form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});


Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
