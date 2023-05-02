<?php

namespace Dply\CMS\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;
use Dply\API\Providers\APIServiceProvider;
use Dply\Backend\Providers\BackendServiceProvider;
use Dply\Backend\Repositories\PostRepository;
use Dply\Backend\Repositories\TaxonomyRepository;
use Dply\CMS\Contracts\ActionRegisterContract;
use Dply\CMS\Contracts\BackendMessageContract;
use Dply\CMS\Contracts\CacheGroupContract;
use Dply\CMS\Contracts\ConfigContract;
use Dply\CMS\Contracts\EventyContract;
use Dply\CMS\Contracts\Field;
use Dply\CMS\Contracts\GlobalDataContract;
use Dply\CMS\Contracts\GoogleTranslate as GoogleTranslateContract;
use Dply\CMS\Contracts\HookActionContract;
use Dply\CMS\Contracts\JuzawebApiContract;
use Dply\CMS\Contracts\JWQueryContract;
use Dply\CMS\Contracts\LocalPluginRepositoryContract;
use Dply\CMS\Contracts\LocalThemeRepositoryContract;
use Dply\CMS\Contracts\MacroableModelContract;
use Dply\CMS\Contracts\OverwriteConfigContract;
use Dply\CMS\Contracts\PostImporterContract;
use Dply\CMS\Contracts\PostManagerContract;
use Dply\CMS\Contracts\ShortCode as ShortCodeContract;
use Dply\CMS\Contracts\ShortCodeCompiler as ShortCodeCompilerContract;
use Dply\CMS\Contracts\StorageDataContract;
use Dply\CMS\Contracts\TableGroupContract;
use Dply\CMS\Contracts\ThemeConfigContract;
use Dply\CMS\Contracts\TranslationFinder as TranslationFinderContract;
use Dply\CMS\Contracts\TranslationManager as TranslationManagerContract;
use Dply\CMS\Contracts\XssCleanerContract;
use Dply\CMS\Extension\Custom;
use Dply\CMS\Facades\OverwriteConfig;
use Dply\CMS\Support\ActionRegister;
use Dply\CMS\Support\CacheGroup;
use Dply\CMS\Support\Config as DbConfig;
use Dply\CMS\Support\DatabaseTableGroup;
use Dply\CMS\Support\GlobalData;
use Dply\CMS\Support\GoogleTranslate;
use Dply\CMS\Support\HookAction;
use Dply\CMS\Support\Html\Field as HtmlField;
use Dply\CMS\Support\Imports\PostImporter;
use Dply\CMS\Support\JuzawebApi;
use Dply\CMS\Support\JWQuery;
use Dply\CMS\Support\MacroableModel;
use Dply\CMS\Support\Manager\BackendMessageManager;
use Dply\CMS\Support\Manager\PostManager;
use Dply\CMS\Support\Manager\TranslationManager;
use Dply\CMS\Support\ShortCode\Compilers\ShortCodeCompiler;
use Dply\CMS\Support\ShortCode\ShortCode;
use Dply\CMS\Support\StorageData;
use Dply\CMS\Support\Theme\ThemeConfig;
use Dply\CMS\Support\Translations\TranslationFinder;
use Dply\CMS\Support\Validators\ModelExists;
use Dply\CMS\Support\Validators\ModelUnique;
use Dply\CMS\Support\XssCleaner;
use Dply\DevTool\Providers\DevToolServiceProvider;
use Dply\Frontend\Providers\FrontendServiceProvider;
use Dply\Network\Providers\NetworkServiceProvider;
use Dply\Translation\Providers\TranslationServiceProvider;
use Laravel\Passport\Passport;
use TwigBridge\Facade\Twig;

class CmsServiceProvider extends ServiceProvider
{
    protected string $basePath = __DIR__.'/..';

    public function boot()
    {
        $this->bootMigrations();
        $this->bootPublishes();
        $this->configureRateLimiting();

        Validator::extend(
            'recaptcha',
            '\Juzaweb\CMS\Support\Validators\ReCaptchaValidator@validate'
        );

        Validator::extend(
            'domain',
            '\Juzaweb\CMS\Support\Validators\DomainValidator@validate'
        );

        Rule::macro(
            'modelExists',
            function (
                string $modelClass,
                string $modelAttribute = 'id',
                callable $callback = null
            ) {
                return new ModelExists($modelClass, $modelAttribute, $callback);
            }
        );

        Rule::macro(
            'modelUnique',
            function (
                string $modelClass,
                string $modelAttribute = 'id',
                callable $callback = null
            ) {
                return new ModelUnique($modelClass, $modelAttribute, $callback);
            }
        );

        Schema::defaultStringLength(150);

        Twig::addExtension(new Custom());

        Paginator::useBootstrapFive();

        OverwriteConfig::init();

        /*$this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('juzacms:update')->everyMinute();
        });*/
    }

    public function register()
    {
        $this->registerSingleton();
        $this->registerConfigs();
        $this->registerProviders();
        Passport::ignoreMigrations();
    }

    protected function registerConfigs()
    {
        $this->mergeConfigFrom(
            $this->basePath.'/config/juzaweb.php',
            'juzaweb'
        );

        $this->mergeConfigFrom(
            $this->basePath.'/config/locales.php',
            'locales'
        );

        $this->mergeConfigFrom(
            $this->basePath.'/config/countries.php',
            'countries'
        );

        $this->mergeConfigFrom(
            $this->basePath.'/config/installer.php',
            'installer'
        );

        $this->mergeConfigFrom(
            $this->basePath.'/config/network.php',
            'network'
        );
    }

    protected function bootMigrations()
    {
        $mainPath = $this->basePath.'/Database/migrations';
        $directories = glob($mainPath.'/*', GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);
        $this->loadMigrationsFrom($paths);
    }

    protected function bootPublishes()
    {
        $this->publishes(
            [
                $this->basePath.'/config/juzaweb.php' => base_path('config/juzaweb.php'),
                $this->basePath.'/config/network.php' => base_path('config/network.php'),
            ],
            'cms_config'
        );
    }

    protected function registerSingleton()
    {
        $this->app->singleton(
            MacroableModelContract::class,
            function () {
                return new MacroableModel();
            }
        );

        $this->app->singleton(
            ActionRegisterContract::class,
            function ($app) {
                return new ActionRegister($app);
            }
        );

        $this->app->singleton(
            ConfigContract::class,
            function ($app) {
                return new DbConfig($app, $app['cache']);
            }
        );

        $this->app->singleton(
            ThemeConfigContract::class,
            function ($app) {
                return new ThemeConfig($app, jw_current_theme());
            }
        );

        $this->app->singleton(
            HookActionContract::class,
            function ($app) {
                return new HookAction(
                    $app[EventyContract::class],
                    $app[GlobalDataContract::class]
                );
            }
        );

        $this->app->singleton(
            GlobalDataContract::class,
            function () {
                return new GlobalData();
            }
        );

        $this->app->singleton(
            XssCleanerContract::class,
            function () {
                return new XssCleaner();
            }
        );

        $this->app->singleton(
            CacheGroupContract::class,
            function ($app) {
                return new CacheGroup($app['cache']);
            }
        );

        $this->app->singleton(
            OverwriteConfigContract::class,
            function ($app) {
                return new DbConfig\OverwriteConfig(
                    $app['config'],
                    $app[ConfigContract::class],
                    $app['request'],
                    $app['translator']
                );
            }
        );

        $this->app->singleton(
            StorageDataContract::class,
            function () {
                return new StorageData();
            }
        );

        $this->app->singleton(
            TableGroupContract::class,
            function ($app) {
                return new DatabaseTableGroup(
                    $app['migrator']
                );
            }
        );

        $this->app->singleton(
            BackendMessageContract::class,
            function ($app) {
                return new BackendMessageManager(
                    $app[ConfigContract::class]
                );
            }
        );

        $this->app->singleton(
            JuzawebApiContract::class,
            function ($app) {
                return new JuzawebApi(
                    $app[ConfigContract::class]
                );
            }
        );

        $this->app->singleton(
            JWQueryContract::class,
            function ($app) {
                return new JWQuery($app['db']);
            }
        );

        $this->app->singleton(
            PostManagerContract::class,
            function ($app) {
                return new PostManager(
                    $app[PostRepository::class]
                );
            }
        );

        $this->app->singleton(
            PostImporterContract::class,
            function ($app) {
                return new PostImporter(
                    $app[PostManagerContract::class],
                    $app[HookActionContract::class],
                    $app[TaxonomyRepository::class]
                );
            }
        );

        $this->app->singleton(
            Field::class,
            function ($app) {
                return new HtmlField();
            }
        );

        $this->app->singleton(
            ShortCodeCompilerContract::class,
            function ($app) {
                return new ShortCodeCompiler();
            }
        );

        $this->app->singleton(
            ShortCodeContract::class,
            function ($app) {
                return new ShortCode($app[ShortCodeCompilerContract::class]);
            }
        );

        $this->app->singleton(
            TranslationFinderContract::class,
            function ($app) {
                return new TranslationFinder();
            }
        );

        $this->app->singleton(
            TranslationManagerContract::class,
            function ($app) {
                return new TranslationManager(
                    $app[LocalPluginRepositoryContract::class],
                    $app[LocalThemeRepositoryContract::class],
                    $app[TranslationFinderContract::class],
                    $app[GoogleTranslateContract::class]
                );
            }
        );

        $this->app->singleton(
            GoogleTranslateContract::class,
            fn ($app) => new GoogleTranslate($app[\Illuminate\Contracts\Filesystem\Factory::class])
        );
    }

    protected function registerProviders()
    {
        $this->app->register(RepositoryServiceProvider::class);
        if (config('network.enable')) {
            $this->app->register(NetworkServiceProvider::class);
        }

        $this->app->register(HookActionServiceProvider::class);
        $this->app->register(PermissionServiceProvider::class);
        $this->app->register(PerformanceServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(PluginServiceProvider::class);
        $this->app->register(ConsoleServiceProvider::class);
        $this->app->register(NotificationServiceProvider::class);
        $this->app->register(DevToolServiceProvider::class);
        $this->app->register(ThemeServiceProvider::class);
        $this->app->register(BackendServiceProvider::class);
        $this->app->register(FrontendServiceProvider::class);
        $this->app->register(ShortCodeServiceProvider::class);

        if (config('juzaweb.translation.enable')) {
            $this->app->register(TranslationServiceProvider::class);
        }

        if (config('juzaweb.api.enable')) {
            $this->app->register(APIServiceProvider::class);
        }
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for(
            'api',
            function (Request $request) {
                return Limit::perMinute(120)
                    ->by($request->user()?->id ?: get_client_ip());
            }
        );
    }
}
