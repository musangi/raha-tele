import './bootstrap';
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Pusher Config
window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Listen for new messages
const userId = "{{ auth()->id() }}"; // Get logged-in user ID
window.Echo.channel(`chat-channel-${userId}`)
    .listen('.message.sent', (data) => {
        console.log('New Message:', data.message);
        
        // Append message to chat area dynamically
        let chatContainer = document.getElementById("message-container");
        let newMessage = `
            <div class="d-flex justify-content-start mb-2">
                <div class="p-3 rounded-lg shadow-sm bg-white" style="max-width: 70%;">
                    <p class="mb-1">${data.message.message}</p>
                    <small class="d-block text-muted">${new Date().toLocaleTimeString()}</small>
                </div>
            </div>
        `;
        chatContainer.innerHTML += newMessage;
        chatContainer.scrollTop = chatContainer.scrollHeight; // Auto-scroll
    });
