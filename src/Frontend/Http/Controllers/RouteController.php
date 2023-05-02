<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

namespace Dply\Frontend\Http\Controllers;

use Illuminate\Support\Facades\App;
use Dply\CMS\Http\Controllers\FrontendController;

class RouteController extends FrontendController
{
    public function index($slug = null)
    {
        $slug = explode('/', $slug);
        $base = apply_filters('theme.permalink.base', $slug[0], $slug);
        $permalink = $this->getPermalinks($base);

        if ($permalink && $callback = $permalink->get('callback')) {
            return $this->callController($callback, 'index', $slug);
        }

        return $this->callController(
            PageController::class,
            'index',
            $slug
        );
    }

    protected function callController($callback, $method = 'index', $parameters = [])
    {
        do_action('theme.call_controller', $callback, $method, $parameters);

        $parameters = array_values($parameters);

        return App::call($callback . '@' . $method, $parameters);
    }
}
