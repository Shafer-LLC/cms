<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://github.com/juzaweb/juzacms
 * @license    GNU V2
 */

use Dply\Backend\Http\Controllers\Backend\CommentController;
use Dply\Backend\Http\Controllers\Backend\TaxonomyController;
use Dply\Backend\Http\Controllers\Backend\PostController;

Route::jwResource(
    'post-type/{type}/comments',
    CommentController::class,
    [
        'name' => 'comments'
    ]
);

Route::jwResource(
    'taxonomy/{type}/{taxonomy}',
    TaxonomyController::class,
    [
        'name' => 'taxonomies'
    ]
);

Route::get(
    'taxonomy/{type}/{taxonomy}/component-item',
    [TaxonomyController::class, 'getTagComponent']
);

Route::jwResource(
    'post-type/{type}',
    PostController::class,
    [
        'name' => 'posts'
    ]
);
