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
        $users = User::where('id', '!=', auth()->id())
            ->get()
            ->map(function ($user) {

                $lastMessage = Message::whereHas('conversation.participants', function ($q) use ($user) {

                    $q->where('user_id', $user->id);
                })->latest()->first();

                $user->last_message = $lastMessage?->message;

                return $user;
            });

        return view('chat.index', [

            'users' => $users,

            'messages' => [],

            'conversation' => null,

            'selectedUser' => null

        ]);
    }

    public function show(User $user)
    {
        $authId = auth()->id();

        $users = User::where('id', '!=', $authId)
            ->get()
            ->map(function ($chatUser) {

                $lastMessage = Message::whereHas('conversation.participants', function ($q) use ($chatUser) {

                    $q->where('user_id', $chatUser->id);
                })->latest()->first();

                $chatUser->last_message = $lastMessage?->message;

                return $chatUser;
            });

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
        )
            ->orderBy('created_at')
            ->get();

        return view('chat.index', [

            'users' => $users,

            'selectedUser' => $user,

            'conversation' => $conversation,

            'messages' => $messages

        ]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([

            'conversation_id' => 'required',

            'message' => 'required'

        ]);

        $conversation = Conversation::findOrFail(
            $request->conversation_id
        );

        $receiver = $conversation->participants()
            ->where('user_id', '!=', auth()->id())
            ->first();

        $message = Message::create([

            'conversation_id' => $request->conversation_id,

            'sender_id' => auth()->id(),

            'receiver_id' => $receiver->user_id,

            'message' => $request->message

        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([

            'success' => true,

            'message' => [

                'id' => $message->id,

                'message' => $message->message,

                'sender_id' => $message->sender_id,

                'receiver_id' => $message->receiver_id,

                'time' => $message->created_at
                    ->format('h:i A')

            ]

        ]);
    }

    public function deleteConversation(Conversation $conversation)
    {
        $conversation->messages()->delete();

        $conversation->participants()->delete();

        $conversation->delete();

        return redirect('/chat')
            ->with('success', 'Chat deleted successfully');
    }
}
