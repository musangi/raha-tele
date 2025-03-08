@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Matches Sidebar -->
       <!-- Matches Sidebar -->
<div class="col-md-4 bg-white shadow-sm border-right p-3" style="height: 85vh; overflow-y: auto;">
    <h4 class="main-color mb-4">💬 Your Matches</h4>

    <!-- Matches List (Vertical, Like a Messaging App) -->
    <div class="list-group">
        @foreach($matches as $match)
            <a href="{{ route('messages.show', $match->id) }}" 
               class="d-flex align-items-center p-2 list-group-item list-group-item-action border-0">
                <img src="{{ $match->profile_picture }}" class="rounded-circle mr-3" 
                     style="width: 50px; height: 50px; object-fit: cover;">
                <div class="flex-grow-1">
                    <p class="mb-1 font-weight-bold text-dark">{{ $match->name }}</p>
                    @if($match->last_message)
                        <p class="text-muted small mb-0">{{ Str::limit($match->last_message->message, 20) }}</p>
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
                    method="POST" class="p-4 bg-white border-t flex">
                  @csrf
                  <input type="text" name="message" class="flex-1 p-2 border rounded-lg" placeholder="Type a message..." required>
                  <button class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Send</button>
              </form>
            @else
                <div class="d-flex align-items-center justify-content-center flex-grow-1">
                    <p class="text-muted">Select a match to start chatting.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Auto-scroll to the bottom of messages
    var messageContainer = document.getElementById("message-container");
    if (messageContainer) {
        messageContainer.scrollTop = messageContainer.scrollHeight;
    }
</script>
@endsection
