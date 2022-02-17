<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Jobs\SendUserCallback;

class UserCreatedCallback
{
    /**
     * Handle the event.
     *
     * @param UserCreated $event
     *
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;

        SendUserCallback::dispatch(['user_id' => $user->id])
            ->onQueue(SendUserCallback::QUEUE_NAME);
    }
}
