<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'description',
        'starting_price',
        'current_price',
        'start_time',
        'end_time',
        'status',
    ];

    // Auction has many bids
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    // Auction has one winning bid (after it closes)
    public function winningBid()
    {
        return $this->hasOne(Bid::class)->latestOfMany();
    }
}

