<?php

namespace App\Events;
use App\Models\Message;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return ['chat-channel-' . $this->message->receiver_id]; // Channel for the receiver
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }
    public function broadcastWith()
    {
        return [
            'message' => [
                'id' => $this->message->id,
                'message' => $this->message->message,
                'sender_id' => $this->message->sender_id,
                'receiver_id' => $this->message->receiver_id,
                'created_at' => $this->message->created_at,
            ],
            'sender_name' => $this->message->sender->name,
            'sender_avatar' => asset('storage/' . $this->message->sender->profile_picture),
        ];
    }
    

}
