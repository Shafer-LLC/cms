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

use Dply\API\Http\Resources\MenuResource;
use Dply\Backend\Repositories\MenuRepository;
use Dply\CMS\Http\Controllers\ApiController;

class MenuController extends ApiController
{
    public function __construct(protected MenuRepository $menuRepository)
    {
    }

    public function show(string $location): MenuResource
    {
        $menu = $this->menuRepository->getFrontendDetailByLocation($location);

        return MenuResource::make($menu);
    }
}
