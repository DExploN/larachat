<?php

namespace App\Http\Controllers;

use App\Events\SendMessageEvent;
use App\Jobs\StoreMessage;
use App\Message;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Room $room)
    {
        $usersForInvite = [];
        if (Auth::user()->id === $room->creator->id) {
            $usersForInvite = User::whereNotIn('id', $room->members->pluck('id'))->whereNotIn('id',
                $room->invites->pluck('id'))->get();
        }
        return view('chat.index', compact('room', 'usersForInvite'));
    }

    public function messages(Room $room)
    {
        $messages = Message::orderBy('id', 'desc')->where('room_id', $room->id)->with('user')->take(10)->get();
        $messages = $messages->reverse();
        return response()->json(array_values($messages->toArray()));
    }

    public function store(Request $request, int $id)
    {
        $this->validate($request, ['text' => 'required|min:5']);
        event(new SendMessageEvent($request->user(), $request->input('text'), $id));
        return redirect()->back();
    }
}
