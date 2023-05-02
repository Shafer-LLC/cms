<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

require __DIR__ . '/components/profile.route.php';

use Dply\CMS\Support\Installer;
use Dply\CMS\Support\Route\Auth;
use Dply\Frontend\Http\Controllers\AjaxController;
use Dply\Frontend\Http\Controllers\FeedController;
use Dply\Frontend\Http\Controllers\HomeController;
use Dply\Frontend\Http\Controllers\PostController;
use Dply\Frontend\Http\Controllers\RouteController;
use Dply\Frontend\Http\Controllers\SearchController;
use Dply\Frontend\Http\Controllers\SitemapController;

Auth::routes();

Route::get(
    'sitemap.xml',
    [SitemapController::class, 'index']
)->name('sitemap.index');

Route::get(
    'sitemap/pages.xml',
    [SitemapController::class, 'pages']
)->name('sitemap.pages');

Route::get(
    'sitemap/{type}/page-{page}.xml',
    [SitemapController::class, 'sitemapPost']
)->name('sitemap.posts');

Route::get(
    'sitemap/taxonomy/{type}/page-{page}.xml',
    [SitemapController::class, 'sitemapTaxonomy']
)->name('sitemap.taxonomies');

Route::get('feed', [FeedController::class, 'index'])->name('feed');
Route::get('taxonomy/{taxonomy}/feed', [FeedController::class, 'taxonomy'])->name('feed.taxonomy');

Route::match(
    ['get', 'post', 'put'],
    'ajax/{slug}',
    [AjaxController::class, 'ajax']
)
    ->name('ajax')
    ->where('slug', '[a-z0-9\-\/]+');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::match(['get', 'post'], 'search', [SearchController::class, 'index'])->name('search');

Route::match(
    ['get', 'post'],
    'search/ajax',
    [SearchController::class, 'ajaxSearch']
)->name('ajax.search');

if (Installer::alreadyInstalled()) {
    Route::post(
        '{slug}',
        [PostController::class, 'comment']
    )
        ->name('comment')
        ->where('slug', '^(?!admin\-cp|api\/).*$');

    Route::get('{slug}', [RouteController::class, 'index'])
        ->where('slug', '^(?!admin\-cp|api\/).*$')
        ->name('post');
}
