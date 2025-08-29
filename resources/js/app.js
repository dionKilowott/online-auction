import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY, // use Vite env
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Listen for AuctionCreated events
window.Echo.channel('auctions')
    .listen('.auction.created', (event) => {
        console.log("📢 New Auction Created:", event.auction);

        // Optional: popup notification
        alert(`New Auction: ${event.auction.item_name}`);

        // ✅ Update notifications list on the dashboard (Step 5)
        let list = document.getElementById('notifications');
        if (list) {
            let item = document.createElement('li');
            item.innerText = `New Auction: ${event.auction.item_name}`;
            list.prepend(item); // Add to top
        }
    });
