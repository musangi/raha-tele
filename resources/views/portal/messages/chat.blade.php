@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Chat</h2>

    <div class="chat-box border rounded p-3" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
        @foreach($messages as $message)
            <div class="d-flex {{ $message->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="p-2 mb-2 rounded shadow-sm"
                     style="max-width: 75%; {{ $message->sender_id == auth()->id() ? 'background-color: #007bff; color: white;' : 'background-color: #e9ecef;' }}">
                    {{ $message->message }}
                    <small class="d-block text-right text-muted">{{ $message->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('chat.store', $userId) }}" method="POST" class="mt-3">
        @csrf
        <div class="input-group">
            <input type="text" name="message" class="form-control" placeholder="Type a message..." required>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Send</button>
            </div>
        </div>
    </form>
</div>
@endsection
