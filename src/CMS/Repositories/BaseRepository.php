<?php

namespace Dply\CMS\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Dply\CMS\Repositories\Contracts\RepositoryCriteriaInterface;
use Dply\CMS\Repositories\Contracts\RepositoryInterface;

/**
 * Interface BaseRepository.
 *
 * @method Builder query()
 * @package namespace Dply\Backend\Repositories;
 */
interface BaseRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    //
}
