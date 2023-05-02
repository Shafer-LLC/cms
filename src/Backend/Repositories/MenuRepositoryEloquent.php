<?php

namespace Dply\Backend\Repositories;

use Dply\Backend\Models\Menu;
use Dply\CMS\Repositories\BaseRepositoryEloquent;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace Dply\Backend\Repositories;
 */
class MenuRepositoryEloquent extends BaseRepositoryEloquent implements MenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Menu::class;
    }

    public function getFrontendDetail(int $menu): Menu
    {
        $result = $this->model->newQuery()
            ->cacheFor(config('juzaweb.performance.query_cache.lifetime'))
            ->where(['id' => $menu])
            ->firstOrFail();

        return $this->parserResult($result);
    }

    public function getFrontendDetailByLocation(string $location): Menu
    {
        $menu = get_menu_by_theme_location($location);
        $result = $this->model->newQuery()
            ->cacheFor(config('juzaweb.performance.query_cache.lifetime'))
            ->where(['id' => $menu])
            ->firstOrFail();

        return $this->parserResult($result);
    }
}
