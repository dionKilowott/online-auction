<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;

class AuctionCreatedNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $auction;

    public function __construct($auction)
    {
        $this->auction = $auction;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // saves to DB + pushes to WebSockets
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "A new auction has been created: {$this->auction->item_name}",
            'auction_id' => $this->auction->id,
        ];
    }

    public function broadcastOn()
    {
        return ['public-auctions']; // public channel
    }

    public function broadcastAs()
    {
        return 'auction.created'; // frontend event name
    }
}
