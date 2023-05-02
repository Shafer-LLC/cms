<?php

namespace Dply\Translation\Providers;

use Dply\CMS\Facades\ActionRegister;
use Dply\CMS\Support\ServiceProvider;
use Dply\Translation\Contracts\TranslationContract;
use Dply\Translation\Support\Locale;
use Dply\Translation\TranslationAction;

class TranslationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'translation');

        ActionRegister::register(TranslationAction::class);
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->singleton(
            TranslationContract::class,
            function () {
                return new Locale();
            }
        );
    }
}
