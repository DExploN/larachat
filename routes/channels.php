<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use Illuminate\Support\Facades\Broadcast;
Broadcast::channel('larachat_chat_{room}', function ($user, int $roomId) {
    return \Illuminate\Support\Facades\Gate::allows('show_room', $roomId);
});
