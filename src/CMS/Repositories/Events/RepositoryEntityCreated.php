<?php

namespace Dply\CMS\Repositories\Events;

use Dply\CMS\Repositories\Events\RepositoryEventBase;

/**
 * Class RepositoryEntityCreated
 *
 * @package Prettus\Repository\Events
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class RepositoryEntityCreated extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "created";
}
