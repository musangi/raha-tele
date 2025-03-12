@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Matches Sidebar -->
    <div class="col-md-4 bg-white shadow-sm border-right p-3" style="height: 85vh; overflow-y: auto;">
    <h4 class="main-color mb-4">💬 Your Matches</h4>

    <!-- Matches List (Vertical, Like a Messaging App) -->
    <div class="list-group">
        @foreach($matches as $match)
            <a href="{{ route('messages.show', $match->id) }}" 
               class="d-flex align-items-center p-2 list-group-item list-group-item-action border-0">
                <img src="{{ $match->profile_picture ? asset('storage/' . $match->profile_picture) : asset('assets/images/profiles/default-avatar.png') }}" 
                     class="rounded-circle mr-3" style="width: 50px; height: 50px; object-fit: cover;">
                     
                <div class="flex-grow-1">
                    <p class="mb-1 font-weight-bold text-dark">{{ $match->name }}</p>
                    @php
                    // $lastMessage = $match->lastMessageWith(auth()->id());
                    $lastMessage = $match->lastMessage->message ?? 'No messages yet';

                    @endphp

                    @if($match->lastMessage)
                    <p class="text-muted small mb-0">{{ Str::limit($match->lastMessage->message, 20) }}</p>
                    @else
                    <p class="text-muted small mb-0">No messages yet</p>
                    @endif

                </div>
            </a>
        @endforeach
    </div>
</div>

        <!-- Chat Section -->
        <div class="col-md-8 d-flex flex-column bg-light" style="height: 85vh;">
            @if(isset($selectedUser))
                <!-- Chat Header -->
                <div class="d-flex align-items-center bg-white border-bottom p-3">
                    <img src="{{ $selectedUser->profile_picture ?? asset('assets/images/profiles/default-avatar.png') }}" 
                        class="rounded-circle mr-3" width="50" height="50" style="object-fit: cover;">
                    <h5 class="m-0 text-primary">{{ $selectedUser->name }}</h5>
                </div>

                <!-- Chat Messages -->
                <div class="flex-grow-1 p-3 overflow-auto" id="message-container" style="max-height: 65vh;">
                    @foreach($messages as $message)
                        <div class="d-flex {{ $message->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }} mb-2">
                            <div class="p-3 rounded-lg shadow-sm {{ $message->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-white' }}" style="max-width: 70%;">
                                <p class="mb-1">{{ $message->message }}</p>
                                <small class="d-block text-right text-muted">{{ $message->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Message Input -->
                
                <form action="{{ route('portal.messages.store', ['userId' => $selectedUser->id ?? '']) }}" 
                    method="POST" class="p-3 bg-white border-top d-flex">
                @csrf
                <input type="text" name="message" 
                        class="form-control flex-grow-1 p-3 rounded-pill border" 
                        placeholder="Type a message..." required>
                <button class="btn btn-primary ml-2 px-4 py-2 rounded-pill">Send</button>
             </form>
            @else
                <div class="d-flex align-items-center justify-content-center flex-grow-1">
                    <p class="text-muted">Select a match to start chatting.</p>
                </div>
            @endif
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.2/pusher.min.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
    var messageContainer = document.getElementById("message-container");

    // Auto-scroll to the bottom of messages
    function scrollToBottom() {
        if (messageContainer) {
            messageContainer.scrollTop = messageContainer.scrollHeight;
        }
    }
    scrollToBottom();

    // Initialize Pusher
    Pusher.logToConsole = false;
    var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
        cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
        encrypted: true
    });

    var userId = "{{ auth()->id() }}";
    var channel = pusher.subscribe("private-chat-channel-" + userId);

    channel.bind("message.sent", function (data) {
        console.log("New message received:", data);

        if (!messageContainer) return;

        var isMine = data.message.sender_id == userId;
        var alignment = isMine ? "justify-content-end" : "justify-content-start";
        var bgColor = isMine ? "bg-primary text-white" : "bg-white";

        // Create message element
        var messageDiv = document.createElement("div");
        messageDiv.className = `d-flex ${alignment} mb-2`;

        var messageContent = document.createElement("div");
        messageContent.className = `p-3 rounded-lg shadow-sm ${bgColor}`;
        messageContent.style.maxWidth = "70%";

        var messageText = document.createElement("p");
        messageText.className = "mb-1";
        messageText.textContent = data.message.message;

        var timeStamp = document.createElement("small");
        timeStamp.className = "d-block text-right text-muted";
        timeStamp.textContent = new Date(data.message.created_at).toLocaleTimeString();

        messageContent.appendChild(messageText);
        messageContent.appendChild(timeStamp);
        messageDiv.appendChild(messageContent);
        messageContainer.appendChild(messageDiv);

        // Auto-scroll to the latest message
        scrollToBottom();

        // Update match list last message preview
        var matchElement = document.querySelector(`a[href="{{ route('messages.show', '') }}/${data.message.sender_id}"] p.text-muted`);
        if (matchElement) {
            matchElement.textContent = data.message.message.length > 20
                ? data.message.message.substring(0, 20) + "..."
                : data.message.message;
        }

        // Show browser notification
        if (Notification.permission === "granted") {
            new Notification("New Message from " + data.sender_name, {
                body: data.message.message,
                icon: data.sender_avatar
            });
        } else if (Notification.permission !== "denied") {
            Notification.requestPermission().then(permission => {
                if (permission === "granted") {
                    new Notification("New Message from " + data.sender_name, {
                        body: data.message.message,
                        icon: data.sender_avatar
                    });
                }
            });
        }
    });
});

</script>
@endsection
