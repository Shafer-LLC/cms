<?php

namespace Dply\Backend\Repositories;

use Dply\CMS\Models\User;
use Dply\CMS\Repositories\BaseRepositoryEloquent;

/**
 * Class UserRepositoryEloquent.
 *
 * @property User $model
 */
class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
