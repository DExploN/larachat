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
        return view('chat.index');
    }

    public function messages()
    {
        $messages = Message::orderBy('id', 'desc')->with('user')->take(10)->get();
        $messages = $messages->reverse();
        return response()->json(array_values($messages->toArray()));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['text' => 'required|min:5']);
        //StoreMessage::dispatch($request->input('text'), $request->user());
        event(new SendMessageEvent($request->user(), $request->input('text')));
        return redirect()->back();
    }
}
