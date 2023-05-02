<?php


use Dply\API\Http\Controllers\SettingController;
use Dply\API\Http\Controllers\SidebarController;
use Dply\API\Http\Middleware\Admin;

Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['auth:api', Admin::class],
    ],
    function () {
        require __DIR__.'/api/admin/api.php';
    }
);

if (config('juzaweb.api.frontend.enable')) {
    require __DIR__.'/api/auth.php';
    require __DIR__.'/api/post.php';
    require __DIR__.'/api/taxonomy.php';
    require __DIR__.'/api/user.php';
    require __DIR__.'/api/menu.php';

    Route::get('setting', [SettingController::class, 'index']);
    Route::get('sidebar/{sidebar}', [SidebarController::class, 'show']);
}
