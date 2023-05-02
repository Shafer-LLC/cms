<?php

namespace Dply\Backend\Repositories;

use Dply\Backend\Models\Notification;
use Dply\CMS\Repositories\BaseRepositoryEloquent;

/**
 * Class NotificationRepositoryRepositoryEloquent.
 *
 * @property Notification $model
 */
class NotificationRepositoryEloquent extends BaseRepositoryEloquent implements NotificationRepository
{
    public function model(): string
    {
        return Notification::class;
    }
}
