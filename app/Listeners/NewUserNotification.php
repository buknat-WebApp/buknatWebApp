<?php

namespace App\Listeners;

use App\Notifications\RegisterUser;
use Illuminate\Foundation\Auth\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NewUserNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event)
    {
        $admin = User::whereHas('role', function ($query) {
            $query->where('id', 1);
        })->get();

        Notification::send($admin, new RegisterUser($event->user));
    }
}
