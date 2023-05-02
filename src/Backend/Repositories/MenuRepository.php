<?php

namespace Dply\Backend\Repositories;

use Dply\Backend\Models\Menu;
use Dply\CMS\Repositories\BaseRepository;

/**
 * Interface CommentRepository.
 *
 * @package namespace Dply\Backend\Repositories;
 */
interface MenuRepository extends BaseRepository
{
    public function getFrontendDetail(int $menu): Menu;

    public function getFrontendDetailByLocation(string $location): Menu;
}
