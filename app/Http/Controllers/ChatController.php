<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Helpers\PseudoHelper;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        // Génération automatique d’un pseudo si pas déjà défini
        if (!$request->session()->has('pseudo')) {
            $request->session()->put('pseudo', PseudoHelper::generate());
        }

        // Messages des 60 derniers jours
        $messages = Message::where('created_at', '>=', Carbon::now()->subDays(60))
            ->orderBy('created_at', 'asc')
            ->get();

        return view('direct', [
            'messages' => $messages,
            'pseudo' => $request->session()->get('pseudo')
        ]);
    }

    public function send(Request $request)
    {
        $request->validate(['content' => 'required|string|max:500']);

        $message = Message::create([
            'pseudo' => $request->session()->get('pseudo'),
            'content' => $request->content,
        ]);

        // Diffusion du message en temps réel
        broadcast(new \App\Events\MessageSent($message))->toOthers();

        return response()->json($message);
    }
}