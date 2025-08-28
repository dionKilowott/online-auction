<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
     public function placeBid(Request $request, Auction $auction)
    {
        $request->validate([
            'bid_amount' => 'required|numeric|min:0.01',
        ]);

        try {
            DB::transaction(function () use ($request, $auction) {
                $latestBid = $auction->bids()->latest()->first(); 
                $minBid = $latestBid
                    ? $latestBid->bid_amount + 1
                    : $auction->starting_price;

                if ($request->bid_amount < $minBid) {
                    throw new \Exception("Bid must be at least $minBid");
                }

                $auction->bids()->create([
                    'user_id' => Auth::id(),
                    'bid_amount' => $request->bid_amount,
                ]);

                $auction->update(['current_price' => $request->bid_amount]);
            });
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('auctions.index')->with('success', 'Bid placed successfully!');
    }

    public function index() //view all bids
    {
        $bids = Bid::with('auction')->where('user_id', Auth::id())->get();
        return view('dashboard.bids', compact('bids'));
    }

}
