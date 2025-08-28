<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')    // if logged in → dashboard
        : redirect()->route('login');       // if not logged in → login page
});

Route::get('/home', function () {
    return redirect()->route('dashboard'); // always redirect to dashboard
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (requires login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Auctions
    Route::get('/auctions', [AuctionController::class, 'index'])
        ->name('auctions.index');
    Route::post('/auctions', [AuctionController::class, 'store'])
        ->name('auctions.store');
    Route::post('/auctions/{auction}/bid', [BidController::class, 'placeBid'])
        ->name('auctions.bid');
    Route::get('/bids', [BidController::class, 'index'])->name('bids.index');
});
