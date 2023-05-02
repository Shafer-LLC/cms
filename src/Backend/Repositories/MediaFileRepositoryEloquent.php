<?php

namespace Dply\Backend\Repositories;

use Dply\Backend\Models\MediaFile;
use Dply\CMS\Repositories\BaseRepositoryEloquent;
use Dply\CMS\Traits\Criterias\UseFilterCriteria;
use Dply\CMS\Traits\Criterias\UseSearchCriteria;
use Dply\CMS\Traits\Criterias\UseSortableCriteria;

/**
 * Class MediaFileRepositoryEloquent.
 *
 * @package namespace Dply\Backend\Repositories;
 */
class MediaFileRepositoryEloquent extends BaseRepositoryEloquent implements MediaFileRepository
{
    use UseSortableCriteria, UseFilterCriteria, UseSearchCriteria;

    protected array $searchableFields = ['name'];
    protected array $filterableFields = ['folder_id', 'type'];
    protected array $sortableFields = ['id', 'size'];
    protected array $sortableDefaults = ['id' => 'DESC'];

    public function model(): string
    {
        return MediaFile::class;
    }
}
