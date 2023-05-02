<?php

namespace Dply\CMS\Traits;

use Dply\CMS\Exceptions\FileAlreadyExistException;
use Dply\CMS\Support\Generators\FileGenerator;
use Dply\CMS\Support\Stub;

trait ModuleCommandTrait
{
    /**
     * Get the plugin name.
     *
     * @return string
     */
    public function getModuleName(): string
    {
        $module = $this->argument('module');
        $module = app('plugins')->findOrFail($module);
        return $module->getName();
    }

    protected function makeFile($path, $contents): void
    {
        try {
            $overwriteFile = $this->hasOption('force') ? $this->option('force') : false;
            (new FileGenerator($path, $contents))
                ->withFileOverwrite($overwriteFile)
                ->generate();

            $path = realpath($path);
            $this->info("Created : {$path}");
        } catch (FileAlreadyExistException $e) {
            $path = realpath($path);
            $this->error("File : {$path} already exists.");
        }
    }

    protected function stubRender($file, $data): string
    {
        return (new Stub('/' . $file, $data))->render();
    }
}
