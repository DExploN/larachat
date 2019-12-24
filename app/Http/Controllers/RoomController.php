<?php

namespace App\Http\Controllers;

use App\Events\SendMessageEvent;
use App\Message;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = $request->user()->rooms;
        return view('rooms.index', compact('rooms'));
    }


    public function store(Request $request)
    {
        $room = $request->user()->ownedRooms()->save(new Room($request->only(['name'])));
        $request->user()->rooms()->attach($room);
        return redirect()->back();
    }

    public function show(Room $room)
    {
        $usersForInvite = [];
        if (Auth::user()->id === $room->creator->id) {
            $usersForInvite = User::whereNotIn('id', $room->members->pluck('id'))->whereNotIn('id',
                $room->invites->pluck('id'))->get();
        }
        return view('rooms.show', compact('room', 'usersForInvite'));
    }

    public function messages(Room $room)
    {
        $messages = Message::orderBy('id', 'desc')->where('room_id', $room->id)->with('user')->take(10)->get();
        $messages = $messages->reverse();
        return response()->json(array_values($messages->toArray()));
    }

    public function storeMessage(Request $request, int $id)
    {
        $this->validate($request, ['text' => 'required|min:5']);
        event(new SendMessageEvent($request->user(), $request->input('text'), $id));
        return redirect()->back();
    }

    public function storeInvite(Room $room, Request $request)
    {
        $room->invites()->attach($request->input('user'));
        return redirect()->back();
    }

    public function invites(Request $request)
    {
        $rooms = $request->user()->invites()->get();
        return view('rooms.invites', compact('rooms'));
    }

    public function deleteInvite(Request $request, Room $room)
    {
        if ($request->input('status')) {
            $room->members()->attach($request->user());
        }
        $room->invites()->detach($request->user());
        return redirect()->back();
    }
}
