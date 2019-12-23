<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var User
     */
    public $user_id;
    public $text;
    public $room_id;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param $text
     * @param $room_id
     */
    public function __construct(User $user, $text, $room_id)
    {
        //
        $this->user_id = $user->id;
        $this->text = $text;
        $this->room_id = $room_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat_' . $this->room_id);
    }

}
