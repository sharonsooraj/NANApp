<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('chat.index', compact('users'));
    }

    public function show(User $user)
    {
        $authId = auth()->id();

        $users = User::where('id', '!=', $authId)->get();

        $conversation = Conversation::whereHas('participants', function ($q) use ($authId) {
            $q->where('user_id', $authId);
        })
            ->whereHas('participants', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->first();

        if (!$conversation) {

            $conversation = Conversation::create([
                'type' => 'private'
            ]);

            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $authId
            ]);

            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $user->id
            ]);
        }

        $messages = Message::where(
            'conversation_id',
            $conversation->id
        )->orderBy('created_at')->get();

        return view(
            'chat.index',
            [
                'users' => $users,
                'selectedUser' => $user,
                'conversation' => $conversation,
                'messages' => $messages
            ]
        );
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => auth()->id(),
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}
