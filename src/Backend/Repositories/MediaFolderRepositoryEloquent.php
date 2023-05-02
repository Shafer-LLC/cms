<?php

namespace Dply\Backend\Repositories;

use Dply\Backend\Models\MediaFolder;
use Dply\CMS\Repositories\BaseRepositoryEloquent;
use Dply\CMS\Traits\Criterias\UseFilterCriteria;
use Dply\CMS\Traits\Criterias\UseSearchCriteria;
use Dply\CMS\Traits\Criterias\UseSortableCriteria;

/**
 * Class MediaFolderRepositoryEloquent.
 *
 * @property MediaFolder $model
 */
class MediaFolderRepositoryEloquent extends BaseRepositoryEloquent implements MediaFolderRepository
{
    use UseSortableCriteria, UseFilterCriteria, UseSearchCriteria;

    protected array $searchableFields = ['name'];
    protected array $filterableFields = ['folder_id', 'type'];
    protected array $sortableFields = ['id'];
    protected array $sortableDefaults = ['id' => 'DESC'];

    public function model(): string
    {
        return MediaFolder::class;
    }
}
