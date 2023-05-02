<?php

namespace Dply\Backend\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Dply\Backend\Actions\BackupAction;
use Dply\Backend\Actions\EmailAction;
use Dply\Backend\Actions\EnqueueStyleAction;
use Dply\Backend\Actions\MediaAction;
use Dply\Backend\Actions\MenuAction;
use Dply\Backend\Actions\PermissionAction;
use Dply\Backend\Actions\SeoAction;
use Dply\Backend\Actions\SocialLoginAction;
use Dply\Backend\Actions\ToolAction;
use Dply\Backend\Commands\AutoSubmitCommand;
use Dply\Backend\Commands\AutoTagCommand;
use Dply\Backend\Commands\EmailTemplateGenerateCommand;
use Dply\Backend\Commands\ImportTranslationCommand;
use Dply\Backend\Commands\PermissionGenerateCommand;
use Dply\Backend\Commands\ThemePublishCommand;
use Dply\Backend\Commands\TransFromEnglish;
use Dply\Backend\Models\Comment;
use Dply\Backend\Models\Menu;
use Dply\Backend\Models\Post;
use Dply\Backend\Models\Taxonomy;
use Dply\Backend\Observers\CommentObserver;
use Dply\Backend\Observers\MenuObserver;
use Dply\Backend\Observers\PostObserver;
use Dply\Backend\Observers\TaxonomyObserver;
use Dply\Backend\Repositories\CommentRepository;
use Dply\Backend\Repositories\CommentRepositoryEloquent;
use Dply\Backend\Repositories\MediaFileRepository;
use Dply\Backend\Repositories\MediaFileRepositoryEloquent;
use Dply\Backend\Repositories\MediaFolderRepository;
use Dply\Backend\Repositories\MediaFolderRepositoryEloquent;
use Dply\Backend\Repositories\MenuRepository;
use Dply\Backend\Repositories\MenuRepositoryEloquent;
use Dply\Backend\Repositories\NotificationRepository;
use Dply\Backend\Repositories\NotificationRepositoryEloquent;
use Dply\Backend\Repositories\PostRepository;
use Dply\Backend\Repositories\PostRepositoryEloquent;
use Dply\Backend\Repositories\ResourceRepository;
use Dply\Backend\Repositories\ResourceRepositoryEloquent;
use Dply\Backend\Repositories\TaxonomyRepository;
use Dply\Backend\Repositories\TaxonomyRepositoryEloquent;
use Dply\Backend\Repositories\UserRepository;
use Dply\Backend\Repositories\UserRepositoryEloquent;
use Dply\CMS\Facades\ActionRegister;
use Dply\CMS\Http\Middleware\Admin;
use Dply\CMS\Facades\Field;
use Dply\CMS\Support\Macros\RouterMacros;
use Dply\CMS\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public array $bindings = [
        PostRepository::class => PostRepositoryEloquent::class,
        TaxonomyRepository::class => TaxonomyRepositoryEloquent::class,
        UserRepository::class => UserRepositoryEloquent::class,
        MediaFileRepository::class => MediaFileRepositoryEloquent::class,
        MediaFolderRepository::class => MediaFolderRepositoryEloquent::class,
        NotificationRepository::class => NotificationRepositoryEloquent::class,
        CommentRepository::class => CommentRepositoryEloquent::class,
        MenuRepository::class => MenuRepositoryEloquent::class,
        ResourceRepository::class => ResourceRepositoryEloquent::class,
    ];

    public function boot()
    {
        $this->bootMiddlewares();
        $this->bootPublishes();

        Taxonomy::observe(TaxonomyObserver::class);
        Post::observe(PostObserver::class);
        Menu::observe(MenuObserver::class);
        Comment::observe(CommentObserver::class);

        ActionRegister::register(
            [
                MenuAction::class,
                EnqueueStyleAction::class,
                PermissionAction::class,
                SocialLoginAction::class,
                ToolAction::class,
                SeoAction::class,
                BackupAction::class,
                MediaAction::class,
                EmailAction::class,
            ]
        );

        $this->commands(
            [
                PermissionGenerateCommand::class,
                ImportTranslationCommand::class,
                TransFromEnglish::class,
                EmailTemplateGenerateCommand::class,
                ThemePublishCommand::class,
                AutoSubmitCommand::class,
                AutoTagCommand::class,
            ]
        );
    }

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cms');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'cms');

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->registerRouteMacros();
        $this->app->booting(
            function () {
                $loader = AliasLoader::getInstance();
                $loader->alias('Field', Field::class);
            }
        );
    }

    protected function bootMiddlewares()
    {
        /**
         * @var Router $router
         */
        $router = $this->app['router'];
        $router->aliasMiddleware('admin', Admin::class);
    }

    protected function bootPublishes()
    {
        $this->publishes(
            [
                __DIR__ . '/../resources/views' => resource_path('views/vendor/cms'),
            ],
            'cms_views'
        );

        $this->publishes(
            [
                __DIR__ . '/../resources/lang' => resource_path('lang/cms'),
            ],
            'cms_lang'
        );

        $this->publishes(
            [
                __DIR__ . '/../resources/assets/public' => public_path('jw-styles/juzaweb'),
            ],
            'cms_assets'
        );
    }

    protected function registerRouteMacros()
    {
        Router::mixin(new RouterMacros());
    }
}
