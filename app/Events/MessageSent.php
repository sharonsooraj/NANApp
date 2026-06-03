<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        return [

            // realtime current chat
            new PrivateChannel(
                'chat.' . $this->message->conversation_id
            ),

            // realtime sidebar updates
            new PrivateChannel(
                'user.' . $this->message->receiver_id
            )

        ];
    }

    public function broadcastWith(): array
    {
        return [

            'id' => $this->message->id,

            'message' => $this->message->message,

            'sender_id' => $this->message->sender_id,

            'receiver_id' => $this->message->receiver_id,

            'conversation_id' => $this->message->conversation_id,

            'time' => $this->message->created_at
                ->format('h:i A')

        ];
    }
}
