<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Request;

class AuthLoginHandler
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function login($event) {
        activity('auth-login')->causedBy($event->user->id)
            ->withProperties(['ip',Request::ip(), 'agent', Request::userAgent()])
        ->log($event->user->lastname.' '.$event->user->firstname.' logged in.');
    }
    public function logout($event) {
        activity('auth-logout')->causedBy($event->user->id)
            ->withProperties(['ip',Request::ip(), 'agent', Request::userAgent()])
            ->log($event->user->lastname.' '.$event->user->firstname.' logged out.');
    }
    public function failed($event) {
        if (!empty($event->user)) {
            activity('auth-invalid')->causedBy($event->user->id)
                ->withProperties(['ip',Request::ip(), 'agent', Request::userAgent()])
                ->log('An failed login attempt was made for this email.');
        }
    }
}
