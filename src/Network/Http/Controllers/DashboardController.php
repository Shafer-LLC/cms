<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Dply\Network\Http\Controllers;

use Illuminate\Contracts\View\View;
use Dply\CMS\Http\Controllers\BackendController;

class DashboardController extends BackendController
{
    public function index(): View
    {
        $title = trans('cms::app.dashboard');

        return view('network::dashboard', compact('title'));
    }
}
