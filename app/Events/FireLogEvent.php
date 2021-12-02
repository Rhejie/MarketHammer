<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FireLogEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $identity;
    private $payload;

    public function __construct($identity, $payload)
    {
        $this->identity = $identity;
        $this->payload = $payload;
    }

    public function broadcastOn()
    {
        return new Channel('user-log-event.'.$this->identity);
    }

    public function broadcastWith()
    {
        return $this->payload;
    }

    public function broadcastAs()
    {
        return "new-log-event";
    }

}
