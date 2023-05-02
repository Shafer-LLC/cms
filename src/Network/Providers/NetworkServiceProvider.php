<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Dply\Network\Providers;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;
use Dply\CMS\Facades\ActionRegister;
use Dply\CMS\Support\ServiceProvider;
use Dply\Network\Commands\ArtisanCommand;
use Dply\Network\Commands\MakeSiteCommand;
use Dply\Network\Contracts\NetworkRegistionContract;
use Dply\Network\Contracts\SiteCreaterContract;
use Dply\Network\Contracts\SiteManagerContract;
use Dply\Network\Contracts\SiteSetupContract;
use Dply\Network\Facades\Network;
use Dply\Network\Models\Site;
use Dply\Network\NetworkAction;
use Dply\Network\Observers\SiteModelObserver;
use Dply\Network\Support\NetworkRegistion;
use Dply\Network\Support\SiteCreater;
use Dply\Network\Support\SiteManager;
use Dply\Network\Support\SiteSetup;

class NetworkServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Network::init();

        $this->commands([MakeSiteCommand::class, ArtisanCommand::class]);

        Site::observe([SiteModelObserver::class]);

        ActionRegister::register(NetworkAction::class);
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'network');

        $this->app->singleton(
            SiteSetupContract::class,
            function ($app) {
                return new SiteSetup(
                    $app['config'],
                    $app['db']
                );
            }
        );

        $this->app->singleton(
            SiteCreaterContract::class,
            function ($app) {
                return new SiteCreater(
                    $app['db'],
                    $app['config'],
                    $app[SiteSetupContract::class]
                );
            }
        );

        $this->app->singleton(
            NetworkRegistionContract::class,
            function ($app) {
                return new NetworkRegistion(
                    $app,
                    $app['config'],
                    $app['request'],
                    $app['cache'],
                    $app['db'],
                    $app[SiteSetupContract::class],
                    $app[Kernel::class]
                );
            }
        );

        $this->app->singleton(
            SiteManagerContract::class,
            function ($app) {
                return new SiteManager(
                    $app['db'],
                    $app[SiteCreaterContract::class]
                );
            }
        );
    }
}
