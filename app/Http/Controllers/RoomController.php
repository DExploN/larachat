<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

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
