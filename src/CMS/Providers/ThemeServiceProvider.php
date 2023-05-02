<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

namespace Dply\CMS\Providers;

use Illuminate\Support\Facades\Lang;
use Dply\CMS\Contracts\ThemeLoaderContract;
use Dply\CMS\Contracts\LocalThemeRepositoryContract;
use Dply\CMS\Facades\ActionRegister;
use Dply\CMS\Facades\ThemeLoader;
use Dply\CMS\Support\ServiceProvider;
use Dply\CMS\Support\Theme\Theme;
use Dply\CMS\Support\LocalThemeRepository;
use Dply\Frontend\Actions\FrontendAction;
use Dply\Frontend\Actions\ThemeAction;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Lang::addJsonPath(ThemeLoader::getPath(jw_current_theme(), 'lang'));
        ActionRegister::register(
            [
                ThemeAction::class,
                FrontendAction::class,
            ]
        );
    }

    public function register()
    {
        $this->app->singleton(
            ThemeLoaderContract::class,
            function ($app) {
                return new Theme($app, $app['view']->getFinder(), $app['config'], $app['translator']);
            }
        );

        $this->app->singleton(
            LocalThemeRepositoryContract::class,
            function ($app) {
                $path = config('juzaweb.theme.path');
                return new LocalThemeRepository($app, $path);
            }
        );

        $this->app->alias(LocalThemeRepositoryContract::class, 'themes');
    }
}
