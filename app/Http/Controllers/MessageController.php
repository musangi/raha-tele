<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($userId = null)
    {
        $user = Auth::user();

        // Fetch all users the current user has matched with (sent or received a message)
        $matches = User::whereIn('id', function ($query) use ($user) {
            $query->select('receiver_id')
                ->from('messages')
                ->where('sender_id', $user->id)
                ->union(
                    (clone $query)->select('sender_id')
                        ->from('messages')
                        ->where('receiver_id', $user->id)
                );
        })->get();

        // If no user is selected, just show the matches list
        if (!$userId) {
            return view('portal.messages.index', compact('matches'));
        }

        // Fetch conversation with the selected user
        $messages = Message::where(function ($query) use ($user, $userId) {
            $query->where('sender_id', $user->id)->where('receiver_id', $userId);
        })
        ->orWhere(function ($query) use ($user, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $user->id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        $selectedUser = User::find($userId);

        return view('portal.messages.index', compact('matches', 'messages', 'selectedUser', 'userId'));
    }

    /**
     * Store a newly created message.
     */
    public function store(Request $request, $userId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = new Message();
        $message->sender_id = Auth::id();
        $message->receiver_id = $userId;
        $message->message = $request->message;
        $message->save();
        // Broadcast the message to Pusher
        broadcast(new MessageSent($message))->toOthers();

        return redirect()->route('messages.show', ['userId' => $userId]); // Ensure route is correct
    }

    /**
     * Display the specified conversation.
     */
    public function show($userId)
    {
        $user = Auth::user();
        $selectedUser = User::findOrFail($userId);

        // Fetch all users the current user has matched with
        $matches = User::whereIn('id', function ($query) use ($user) {
            $query->select('receiver_id')
                ->from('messages')
                ->where('sender_id', $user->id)
                ->union(
                    (clone $query)->select('sender_id')
                        ->from('messages')
                        ->where('receiver_id', $user->id)
                );
        })->get();

        // Fetch conversation messages
        $messages = Message::where(function ($query) use ($user, $userId) {
            $query->where('sender_id', $user->id)->where('receiver_id', $userId);
        })
        ->orWhere(function ($query) use ($user, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $user->id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        return view('portal.messages.index', compact('matches', 'messages', 'selectedUser', 'userId'));
    }
}
