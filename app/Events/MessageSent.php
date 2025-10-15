// app/Events/MessageSent.php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;
    public $onlineCount; // pour envoyer le nombre en ligne (optionnel)

    public function __construct(Message $message, $onlineCount = null)
    {
        $this->message = $message;
        $this->onlineCount = $onlineCount;
    }

    public function broadcastOn(): Channel
    {
        // canal public ou privé selon ton besoin
        return new Channel('chat');
    }

    public function broadcastWith(): array
    {
        return [
            'message' => [
                'pseudo' => $this->message->pseudo,
                'content' => $this->message->content,
                'created_at' => $this->message->created_at->toDateTimeString(), // timestamp
            ],
            'onlineCount' => $this->onlineCount,
        ];
    }
}
