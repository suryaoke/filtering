<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('sales', SalesController::class);
    Route::resource('products', \App\Http\Controllers\ProductController::class);
});


Route::post('/theme/toggle', function () {
    $current = session('theme', 'light');
    $new     = $current === 'light' ? 'dark' : 'light';
    session(['theme' => $new]);
    return response()->json(['theme' => $new])
        ->cookie('theme', $new, 60 * 24 * 365);
})->name('theme.toggle');