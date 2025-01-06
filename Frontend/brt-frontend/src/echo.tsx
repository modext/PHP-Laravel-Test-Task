import Echo from "laravel-echo";
import Pusher from "pusher-js";

// Assign Pusher to the global window object
window.Pusher = Pusher;

// Configure Laravel Echo with Pusher
const echo = new Echo({
    broadcaster: "pusher",
    key: "024b7ef65c69a48f92f3", 
    cluster: "mt1",            
    forceTLS: true,          
});


export default echo;
