<?php

namespace Dply\Backend\Policies;

use Dply\CMS\Abstracts\ResourcePolicy;

class UserPolicy extends ResourcePolicy
{
    protected string $resourceType = 'users';
}
