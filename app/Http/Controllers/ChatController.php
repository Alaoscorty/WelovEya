<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Cache;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('pseudo')) {
            $pseudo = 'Invité_' . rand(1000, 9999);
            $request->session()->put('pseudo', $pseudo);
        }

        return view('direct', [
            'pseudo' => $request->session()->get('pseudo')
        ]);
    }

    public function getMessages()
    {
        Message::where('created_at', '<', now()->subDays(60))->delete();
        return response()->json(Message::latest()->take(100)->get()->reverse()->values());
    }

    public function sendMessage(Request $request)
    {
        $request->validate(['message' => 'required|string|max:500']);

        $pseudo = $request->session()->get('pseudo');
        $message = Message::create(['pseudo' => $pseudo, 'message' => $request->message]);

        broadcast(new MessageSent($message))->toOthers();

        Cache::put('user_' . $pseudo, now(), 120);

        return response()->json($message);
    }

    public function getOnlineCount()
    {
        $users = collect(Cache::get('users', []))->filter(function ($time) {
            return now()->diffInMinutes($time) < 2;
        });

        return response()->json(['count' => $users->count()]);
    }
}