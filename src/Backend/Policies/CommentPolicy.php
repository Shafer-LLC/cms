<?php

namespace Dply\Backend\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Dply\CMS\Models\Model;
use Dply\CMS\Models\User;

class CommentPolicy
{
    use HandlesAuthorization;

    public function index(User $user, $type): bool
    {
        if (!$user->can("{$type}.comments.index")) {
            return false;
        }

        return true;
    }

    public function edit(User $user, Model $model, $type)
    {
        if (!$user->can("{$type}.comments.edit")) {
            return false;
        }

        return true;
    }

    public function create(User $user, $type)
    {
        if (!$user->can("{$type}.comments.create")) {
            return false;
        }

        return true;
    }

    public function delete(User $user, Model $model, $type)
    {
        if (!$user->can("{$type}.comments.delete")) {
            return false;
        }

        return true;
    }
}
