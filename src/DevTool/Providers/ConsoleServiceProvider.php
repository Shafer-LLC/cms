<?php

namespace Dply\DevTool\Providers;

use Illuminate\Support\ServiceProvider;
use Dply\DevTool\Commands\CacheSizeCommand;
use Dply\DevTool\Commands\MakeAdminCommand;
use Dply\DevTool\Commands\Plugin\ActionMakeCommand;
use Dply\DevTool\Commands\Plugin\CommandMakeCommand;
use Dply\DevTool\Commands\Plugin\ControllerMakeCommand;
use Dply\DevTool\Commands\Plugin\DisableCommand;
use Dply\DevTool\Commands\Plugin\EnableCommand;
use Dply\DevTool\Commands\Plugin\EventMakeCommand;
use Dply\DevTool\Commands\Plugin\TranslateViaGoogleCommand;
use Dply\DevTool\Commands\Plugin\ImportTranslationCommand;
use Dply\DevTool\Commands\Plugin\InstallCommand as PluginInstallCommand;
use Dply\DevTool\Commands\Plugin\JobMakeCommand;
use Dply\DevTool\Commands\Plugin\LaravelModulesV6Migrator;
use Dply\DevTool\Commands\Plugin\ListCommand;
use Dply\DevTool\Commands\Plugin\ListenerMakeCommand;
use Dply\DevTool\Commands\Plugin\MiddlewareMakeCommand;
use Dply\DevTool\Commands\Plugin\MigrateCommand;
use Dply\DevTool\Commands\Plugin\MigrateRefreshCommand;
use Dply\DevTool\Commands\Plugin\MigrateResetCommand;
use Dply\DevTool\Commands\Plugin\MigrateRollbackCommand;
use Dply\DevTool\Commands\Plugin\MigrateStatusCommand;
use Dply\DevTool\Commands\Plugin\MigrationMakeCommand;
use Dply\DevTool\Commands\Plugin\ModelMakeCommand;
use Dply\DevTool\Commands\Plugin\ModuleDeleteCommand;
use Dply\DevTool\Commands\Plugin\ModuleMakeCommand;
use Dply\DevTool\Commands\Plugin\ProviderMakeCommand;
use Dply\DevTool\Commands\Plugin\PublishCommand;
use Dply\DevTool\Commands\Plugin\RequestMakeCommand;
use Dply\DevTool\Commands\Plugin\ResourceMakeCommand;
use Dply\DevTool\Commands\Plugin\RouteProviderMakeCommand;
use Dply\DevTool\Commands\Plugin\RuleMakeCommand;
use Dply\DevTool\Commands\Plugin\SeedCommand;
use Dply\DevTool\Commands\Plugin\SeedMakeCommand;
use Dply\DevTool\Commands\Plugin\TestMakeCommand;
use Dply\DevTool\Commands\Plugin\UpdateCommand;
use Dply\DevTool\Commands\Resource\DatatableMakeCommand;
use Dply\DevTool\Commands\Resource\JuzawebResouceMakeCommand;
use Dply\DevTool\Commands\Theme\DownloadStyleCommand;
use Dply\DevTool\Commands\Theme\DownloadTemplateCommand;
use Dply\DevTool\Commands\Theme\GenerateDataThemeCommand;
use Dply\DevTool\Commands\Theme\MakeBlockCommand;
use Juzaweb\DevTool\Commands\Theme\ThemeGeneratorCommand;
use Juzaweb\DevTool\Commands\Theme\ThemeListCommand;
use Juzaweb\DevTool\Commands\Theme\ThemeUpdateCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    protected array $commands = [
        PluginInstallCommand::class,
        CommandMakeCommand::class,
        ControllerMakeCommand::class,
        DisableCommand::class,
        //DumpCommand::class,
        EnableCommand::class,
        EventMakeCommand::class,
        JobMakeCommand::class,
        ListenerMakeCommand::class,
        PublishCommand::class,
        //MailMakeCommand::class,
        MiddlewareMakeCommand::class,
        //NotificationMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        ListCommand::class,
        ModuleDeleteCommand::class,
        ModuleMakeCommand::class,
        //FactoryMakeCommand::class,
        //PolicyMakeCommand::class,
        RequestMakeCommand::class,
        RuleMakeCommand::class,
        MigrateCommand::class,
        MigrateRefreshCommand::class,
        MigrateResetCommand::class,
        MigrateRollbackCommand::class,
        MigrateStatusCommand::class,
        MigrationMakeCommand::class,
        ModelMakeCommand::class,
        SeedCommand::class,
        SeedMakeCommand::class,
        //SetupCommand::class,
        //UnUseCommand::class,
        //UseCommand::class,
        ResourceMakeCommand::class,
        TestMakeCommand::class,
        LaravelModulesV6Migrator::class,
        ThemeGeneratorCommand::class,
        ThemeListCommand::class,
        ActionMakeCommand::class,
        DatatableMakeCommand::class,
        JuzawebResouceMakeCommand::class,
        MakeAdminCommand::class,
        GenerateDataThemeCommand::class,
        DownloadStyleCommand::class,
        DownloadTemplateCommand::class,
        UpdateCommand::class,
        ThemeUpdateCommand::class,
        MakeBlockCommand::class,
        CacheSizeCommand::class,
        ImportTranslationCommand::class,
        TranslateViaGoogleCommand::class,
        \Juzaweb\DevTool\Commands\Plugin\ExportTranslationCommand::class,
        \Juzaweb\DevTool\Commands\Plugin\RepositoryMakeCommand::class,
        \Juzaweb\DevTool\Commands\Theme\ExportTranslationCommand::class,
        \Juzaweb\DevTool\Commands\Theme\ImportTranslationCommand::class,
        \Juzaweb\DevTool\Commands\Theme\TranslateViaGoogleCommand::class,
        \Juzaweb\DevTool\Commands\FindFillableColumnCommand::class,
    ];

    /**
     * Register the commands.
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return $this->commands;
    }
}
