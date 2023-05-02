<?php

namespace Dply\CMS\Providers;

use Dply\CMS\Console\Commands\SendNotifyCommand;
use Dply\CMS\Support\Notification;
use Dply\CMS\Support\ServiceProvider;
use Dply\CMS\Support\Notifications\DatabaseNotification;
use Dply\CMS\Support\Notifications\EmailNotification;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Notification::register('database', DatabaseNotification::class);
        Notification::register('mail', EmailNotification::class);
    }

    public function register()
    {
        $this->commands(
            [
                SendNotifyCommand::class,
            ]
        );
    }
}
