<?php

namespace Dply\CMS\Support\Process;

use Dply\CMS\Contracts\LocalPluginRepositoryContract;
use Dply\CMS\Contracts\RunableInterface;

class Runner implements RunableInterface
{
    /**
     * The plugin instance.
     * @var LocalPluginRepositoryContract
     */
    protected $module;

    public function __construct(LocalPluginRepositoryContract $module)
    {
        $this->module = $module;
    }

    /**
     * Run the given command.
     *
     * @param string $command
     */
    public function run($command)
    {
        passthru($command);
    }
}
