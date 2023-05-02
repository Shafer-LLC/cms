<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Dply\API\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Dply\API\Actions\APIAction;
use Dply\CMS\Facades\ActionRegister;
use Dply\CMS\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider
{
    public function boot()
    {
        ActionRegister::register(
            [
                APIAction::class,
            ]
        );
    }

    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'api');

        $this->app->register(RouteServiceProvider::class);
    }
}
