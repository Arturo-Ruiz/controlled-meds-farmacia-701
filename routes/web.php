<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;


Route::redirect('/', 'login', 301);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login-form');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
