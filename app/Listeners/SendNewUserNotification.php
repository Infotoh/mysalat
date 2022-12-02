<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Admin;


class SendNewUserNotification
{
    public function handle($event)
    {
        $admins = Admin::all()->first();

        Notification::send($admins, new NewUserNotification($event->user));
    }
}
