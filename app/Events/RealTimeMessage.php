<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RealTimeMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;



    public $fromUserId ;
    public $messageContent;
    public $toUserId;

    public function __construct($fromUserId,$toUserId,$messageContent)
    {
        $this->fromUserId = $fromUserId;
        $this->messageContent = $messageContent;
        $this->toUserId = $toUserId;

    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('messages.'.$this->toUserId);
    }
}
