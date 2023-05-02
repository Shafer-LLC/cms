<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

use Dply\Backend\Http\Controllers\Backend\ResourceController;
use Dply\Backend\Http\Controllers\Backend\ChildResourceController;
use Dply\Backend\Http\Controllers\Backend\PostResourceController;

Route::jwResource(
    'resources/{type}/{post}',
    PostResourceController::class,
    [
        'name' => 'post_resource',
        'where' => ['post' => '[0-9]+'],
    ]
);

Route::jwResource(
    'resources/{type}/{post}/parent/{parent}',
    ChildResourceController::class,
    [
        'name' => 'child_resource',
        'where' => ['post' => '[0-9]+', 'parent' => '[0-9]+'],
    ]
);

Route::jwResource(
    'resources/{type}',
    ResourceController::class,
    [
        'name' => 'resource',
    ]
);
