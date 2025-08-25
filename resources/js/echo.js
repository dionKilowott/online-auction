import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

// Listen for auction created events
window.Echo.channel("public-auctions")
    .listen(".auction.created", (event) => {
        console.log("📢 New Auction:", event.message);
        alert(event.message); // just for testing
    });