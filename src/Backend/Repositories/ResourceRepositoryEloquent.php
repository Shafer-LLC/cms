<?php

namespace Dply\Backend\Repositories;

use Dply\Backend\Models\Resource;
use Dply\CMS\Repositories\BaseRepositoryEloquent;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace Dply\Backend\Repositories;
 */
class ResourceRepositoryEloquent extends BaseRepositoryEloquent implements ResourceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Resource::class;
    }
}
