import Echo from "laravel-echo";
import Pusher from "pusher-js";

// Assign Pusher to the global window object
window.Pusher = Pusher;

// Configure Laravel Echo with Pusher
const echo = new Echo({
    broadcaster: "pusher",
    key: "your_app_key", // Replace with your Pusher key
    cluster: "mt1",      // Replace with your Pusher cluster
    forceTLS: true,
});

export default echo;
