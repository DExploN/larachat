<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('id', 'desc')->with('user')->take(50)->get();
        $messages = $messages->reverse();
        return view('chat.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['text' => 'required|min:5']);
        $request->user()->messages()->save(new Message(['text' => $request->input('text')]));
        return redirect()->back();
    }
}
