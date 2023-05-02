<?php

namespace Dply\CMS\Repositories\Events;

use Dply\CMS\Repositories\Events\RepositoryEventBase;

/**
 * Class RepositoryEntityUpdated
 *
 * @package Prettus\Repository\Events
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class RepositoryEntityUpdating extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "updating";
}
