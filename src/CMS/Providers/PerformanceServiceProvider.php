<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://github.com/juzaweb/juzacms
 * @license    GNU V2
 */

namespace Dply\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Dply\CMS\Support\BladeMinifyCompiler;

class PerformanceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        if (config('juzaweb.performance.minify_views')) {
            $this->registerBladeCompiler();
        }
    }

    protected function registerBladeCompiler()
    {
        $this->app->singleton(
            'blade.compiler',
            function ($app) {
                return new BladeMinifyCompiler($app['files'], $app['config']['view.compiled']);
            }
        );
    }
}
