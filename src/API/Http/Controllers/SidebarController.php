<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    GNU General Public License v2.0
 */

namespace Dply\API\Http\Controllers;

use Dply\CMS\Http\Controllers\ApiController;

class SidebarController extends ApiController
{
    public function show(string $sidebar): \Illuminate\Http\JsonResponse
    {
        $config = get_theme_config("sidebar_{$sidebar}", []);

        return $this->restSuccess(array_values($config));
    }
}
