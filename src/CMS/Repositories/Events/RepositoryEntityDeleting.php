<?php

namespace Dply\CMS\Repositories\Events;

use Juzaweb\CMS\Repositories\Events\RepositoryEventBase;

/**
 * Class RepositoryEntityDeleted
 *
 * @package Prettus\Repository\Events
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class RepositoryEntityDeleting extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "deleting";
}
