<?php

namespace App\Listener;

use App\Events\SendMessageEvent;
use App\Message;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessageListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SendMessageEvent $event
     * @return void
     */
    public function handle(SendMessageEvent $event)
    {
        Message::create(['text' => $event->text, 'user_id' => $event->user_id, 'room_id' => $event->room_id]);
    }
}
