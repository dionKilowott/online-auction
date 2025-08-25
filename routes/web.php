<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/home', [AuthController::class, 'showLogin'])->name('login');

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
    
    // Dashboard → loads resources/views/dashboard/index.blade.php
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Auctions → loads resources/views/dashboard/auctions.blade.php
    Route::get('/auctions', [AuctionController::class, 'index'])
        ->name('auctions.index');   // ✅ consistent with Blade folder
    Route::post('/auctions', [AuctionController::class, 'store'])
        ->name('auctions.store');
    Route::post('/auctions/{auction}/bid', [AuctionController::class, 'placeBid'])
        ->name('auctions.bid');

    // ---
    // Old bids logic (inside DashboardController)
    // Route::get('/dashboard/bids', [DashboardController::class, 'bids'])->name('dashboard.bids'); // ❌ commented out

    // New BidController route
    Route::get('/my-bids', [BidController::class, 'myBids'])->name('bids.my');   // **
});
