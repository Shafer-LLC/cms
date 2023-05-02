<?php

namespace Dply\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Dply\CMS\Contracts\LocalPluginRepositoryContract;
use Dply\CMS\Facades\ActionRegister;
use Dply\Frontend\Providers\RouteServiceProvider;

class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Booting the package.
     */
    public function boot(): void
    {
        $this->app[LocalPluginRepositoryContract::class]->boot();

        $this->booted(
            function () {
                ActionRegister::init();

                do_action('juzaweb.init');
            }
        );
    }

    /**
     * Register the provider.
     */
    public function register(): void
    {
        $this->app[LocalPluginRepositoryContract::class]->register();

        $this->app->register(RouteServiceProvider::class);
    }
}
