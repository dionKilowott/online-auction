<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Dashboard overview (tiles)
    public function index()
    {
        $user = Auth::user(); //Gets the authenticated user, Auth is part of inbuilt Laravel functionality

        // All bids by the user, with related auction
        $myBids = Bid::with('auction')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Simple static notifications (can be dynamic later)
        $notifications = [
            ['message' => 'Welcome back, ' . $user->name . '!'],
        ];

        return view('dashboard.index', compact('user', 'myBids', 'notifications'));
    }
}
//test
 