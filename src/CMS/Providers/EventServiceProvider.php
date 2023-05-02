<?php

namespace Dply\CMS\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Dply\Backend\Events\AfterPostSave;
use Dply\Backend\Events\DumpAutoloadPlugin;
use Dply\Backend\Listeners\ResizeThumbnailPostListener;
use Dply\Backend\Listeners\SaveSeoMetaPost;
use Dply\CMS\Events\EmailHook;
use Dply\Backend\Events\PostViewed;
use Dply\Backend\Listeners\CountViewPost;
use Dply\CMS\Listeners\SendEmailHook;
use Dply\Backend\Listeners\SendMailRegisterSuccessful;
use Dply\Backend\Events\RegisterSuccessful;
use Dply\Backend\Listeners\DumpAutoloadPluginListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        EmailHook::class => [
            SendEmailHook::class,
        ],
        RegisterSuccessful::class => [
            SendMailRegisterSuccessful::class,
        ],
        PostViewed::class => [
            CountViewPost::class
        ],
        DumpAutoloadPlugin::class => [
            DumpAutoloadPluginListener::class,
        ],
        AfterPostSave::class => [
            SaveSeoMetaPost::class,
            ResizeThumbnailPostListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
