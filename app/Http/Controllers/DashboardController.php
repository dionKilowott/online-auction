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

        // Only winning bids for dashboard (compact view)
        $myBids = Bid::with('auction')
            ->where('user_id', $user->id)
            ->whereRaw('bid_amount = (
                SELECT MAX(bid_amount) 
                FROM bids b2 
                WHERE b2.auction_id = bids.auction_id
            )')
            ->latest()
            ->take(5) // limit to 5 for dashboard preview
            ->get();

        // Example static notifications
        $notifications = [
            ['message' => 'Welcome back, ' . $user->name . '!'],
        ];

        return view('dashboard.index', compact('user', 'myBids', 'notifications'));
    }
}