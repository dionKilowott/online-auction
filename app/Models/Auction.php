<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{


    protected $fillable = [
        'item_name',
        'description',
        'starting_price',
        'current_price',
        'start_time',
        'end_time',
        'status',
    ];

    
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    
    public function winningBid()
    {
        return $this->hasOne(Bid::class)->latestOfMany();
    }
}

