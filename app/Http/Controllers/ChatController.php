<?php

namespace App\Http\Controllers;

use App\Events\SendMessageEvent;
use App\Jobs\StoreMessage;
use App\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('id', 'desc')->with('user')->take(10)->get();
        $messages = $messages->reverse();
        return view('chat.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['text' => 'required|min:5']);
        //StoreMessage::dispatch($request->input('text'), $request->user());
        event(new SendMessageEvent($request->user(), $request->input('text')));
        return redirect()->back();
    }
}
