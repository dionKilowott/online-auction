<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{
    // Show all active auctions
    public function index()
    {
        $auctions = Auction::where('status', 'active')->latest()->get();
        return view('dashboard.auctions', compact('auctions'));
    }

    // Store a new auction
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starting_price' => 'required|numeric|min:0.01',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        Auction::create([
            'item_name' => $request->item_name,
            'description' => $request->description,
            'starting_price' => $request->starting_price,
            'current_price' => $request->starting_price,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'active',
        ]);

        return redirect()->route('auctions.index')->with('success', 'Auction created successfully!');
    }

    
   
}
