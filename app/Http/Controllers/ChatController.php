<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Helpers\PseudoHelper;
use App\Models\Message;
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
            'pseudo' => 'nullable|string|max:50',
            'content' => 'required|string',
        ]);

        $pseudo = $request->pseudo ?: PseudoHelper::generate();

        $message = Message::create([
            'pseudo' => $pseudo,
            'content' => $request->content,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return ['status' => 'Message envoyé !'];
    }
}

