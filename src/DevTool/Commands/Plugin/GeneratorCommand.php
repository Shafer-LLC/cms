<?php

namespace Dply\DevTool\Commands\Plugin;

use Illuminate\Console\Command;
use Dply\CMS\Exceptions\FileAlreadyExistException;
use Dply\CMS\Support\Generators\FileGenerator;

abstract class GeneratorCommand extends Command
{
    /**
     * The name of 'name' argument.
     *
     * @var string
     */
    protected $argumentName = '';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = str_replace('\\', '/', $this->getDestinationFilePath());

        if (! $this->laravel['files']->isDirectory($dir = dirname($path))) {
            $this->laravel['files']->makeDirectory($dir, 0777, true);
        }

        $contents = $this->getTemplateContents();

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

        if (method_exists($this, 'afterHandle')) {
            $this->afterHandle();
        }
    }

    /**
     * Get the destination file path.
     *
     * @return string
     */
    abstract protected function getDestinationFilePath();

    /**
     * Get template contents.
     *
     * @return string
     */
    abstract protected function getTemplateContents();

    /**
     * Get class namespace.
     *
     * @param \Juzaweb\CMS\Support\Plugin $module
     *
     * @return string
     */
    public function getClassNamespace($module)
    {
        $extra = str_replace($this->getClass(), '', $this->argument($this->argumentName));
        $extra = str_replace('/', '\\', $extra);
        $namespace = '';
        $namespace .= '\\' . $module->getStudlyName();
        $namespace .= '\\' . $this->getDefaultNamespace();
        $namespace .= '\\' . $extra;
        $namespace = str_replace('/', '\\', $namespace);
        $namespace = str_replace('src\\', '', $namespace);

        return trim($namespace, '\\');
    }

    /**
     * Get class name.
     *
     * @return string
     */
    public function getClass()
    {
        return class_basename($this->argument($this->argumentName));
    }

    /**
     * Get default namespace.
     *
     * @return string
     */
    public function getDefaultNamespace(): string
    {
        return '';
    }

    public function getModuleNamespace($module)
    {
        return str_replace('/', '\\', $module->getStudlyName());
    }

    public function getDomainName()
    {
        $module = $this->laravel['plugins']->find($this->getModuleName());

        return $module->getExtraJuzaweb('domain');
    }
}
