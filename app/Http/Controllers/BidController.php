<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    // Show all bids of the current user with outbid check
    public function myBids()
    {
        $user = Auth::user();

        $myBids = Bid::with('auction')
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function ($bid) {
                $highestBid = Bid::where('auction_id', $bid->auction_id)
                                ->orderByDesc('bid_amount')
                                ->first();
                $bid->is_winning = $highestBid && $highestBid->id === $bid->id;
                return $bid;
            });

        return view('dashboard.my-bids', [
            'user' => $user,
            'myBids' => $myBids
        ]);
    }
}
