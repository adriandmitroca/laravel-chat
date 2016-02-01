<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Message;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageWasSent extends Event implements ShouldBroadcast
{

    use SerializesModels;

    public $message;


    /**
     * Create a new event instance.
     *
     * @param Message $message
     * @param User    $user
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }


    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [ 'chat' ];
    }
}
