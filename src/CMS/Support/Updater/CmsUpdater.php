<?php

namespace Dply\CMS\Support\Updater;

use Illuminate\Support\Facades\Artisan;
use Dply\Backend\Events\DumpAutoloadPlugin;
use Dply\CMS\Abstracts\UpdateManager;
use Dply\CMS\Console\Commands\ClearCacheCommand;
use Dply\CMS\Version;

class CmsUpdater extends UpdateManager
{
    protected array $updatePaths = [
        'modules',
        'vendor',
        'bootstrap/cache/packages.php',
        'composer.json',
        'composer.lock',
    ];

    public function getCurrentVersion(): string
    {
        return get_version_by_tag(Version::getVersion());
    }

    public function getVersionAvailable(): string
    {
        $uri = 'cms/version-available';
        $data = [
            'current_version' => $this->getCurrentVersion(),
        ];

        $response = $this->api->get($uri, $data);

        $this->responseErrors($response);

        return get_version_by_tag($response->data->version);
    }

    public function afterUpdateFileAndFolder()
    {
        Artisan::call('package:discover', ['--ansi' => true]);
    }

    public function afterFinish()
    {
        Artisan::call(ClearCacheCommand::class);

        Artisan::call('migrate', ['--force' => true]);

        event(new DumpAutoloadPlugin());

        Artisan::call(
            'vendor:publish',
            [
                '--tag' => 'cms_assets',
                '--force' => true,
            ]
        );
    }

    public function getUploadPaths(): array
    {
        if (JW_PLUGIN_AUTOLOAD) {
            return parent::getUploadPaths();
        }

        return [
            'modules',
        ];
    }

    protected function getCacheKey(): string
    {
        return 'cms_update';
    }

    protected function fetchData(): object
    {
        $uri = 'cms/update';

        $response = $this->api->get(
            $uri,
            [
                'current_version' => $this->getCurrentVersion(),
            ]
        );

        $this->responseErrors($response);

        return $response;
    }

    protected function getLocalPath(): string
    {
        return base_path();
    }
}
