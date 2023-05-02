<?php

namespace Dply\CMS\Traits\Permission;

use Dply\CMS\Support\Permission\PermissionRegistrar;

trait RefreshesPermissionCache
{
    public static function bootRefreshesPermissionCache()
    {
        static::saved(
            function () {
                app(PermissionRegistrar::class)->forgetCachedPermissions();
            }
        );

        static::deleted(
            function () {
                app(PermissionRegistrar::class)->forgetCachedPermissions();
            }
        );
    }
}
