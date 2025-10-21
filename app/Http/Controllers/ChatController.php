<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('direct', ['messages' => Message::latest()->take(50)->get()]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'pseudo' => 'required|string|max:50',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'pseudo' => $request->pseudo,
            'content' => $request->content,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return ['status' => 'Message envoyé !'];
    }
}