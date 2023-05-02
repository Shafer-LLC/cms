<?php

namespace Dply\CMS\Support\Notifications;

use Dply\CMS\Events\PusherEvent;

class BroadcastNotification extends NotificationAbstract
{
    public function handle()
    {
        event(new PusherEvent($user, $notification));
    }
}
