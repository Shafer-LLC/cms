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

use Illuminate\Console\Scheduling\Schedule;
use Dply\CMS\Console\Commands\AutoClearSlotCommand;
use Dply\CMS\Console\Commands\ClearCacheCommand;
use Dply\CMS\Console\Commands\ClearCacheExpiredCommand;
use Dply\CMS\Console\Commands\InstallCommand;
use Dply\CMS\Console\Commands\PluginAutoloadCommand;
use Dply\CMS\Console\Commands\SendMailCommand;
use Dply\CMS\Console\Commands\ShowSlotCommand;
use Dply\CMS\Console\Commands\UpdateCommand;
use Dply\CMS\Console\Commands\VersionCommand;
use Dply\CMS\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    protected array $commands = [
        InstallCommand::class,
        UpdateCommand::class,
        SendMailCommand::class,
        ClearCacheCommand::class,
        PluginAutoloadCommand::class,
        AutoClearSlotCommand::class,
        ShowSlotCommand::class,
        ClearCacheExpiredCommand::class,
        VersionCommand::class
    ];

    public function boot()
    {
        $this->app->booted(
            function () {
                $schedule = $this->app->make(Schedule::class);
                $schedule->command(AutoClearSlotCommand::class)->hourly();

                if (get_config('jw_auto_ping')) {
                    $schedule->command('juzacms:auto-submit')->daily();
                }

                if (get_config('jw_backup_enable')) {
                    $schedule->command('backup:clean')->daily();
                    $time = get_config('jw_backup_time', 'daily');
                    switch ($time) {
                        case 'weekly':
                            $schedule->command('backup:run')->weekly();
                            break;
                        case 'monthly':
                            $schedule->command('backup:run')->monthly();
                            break;
                        default:
                            $schedule->command('backup:run')->daily();
                    }
                }
            }
        );
    }

    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return $this->commands;
    }
}
