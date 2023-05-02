<?php

namespace Dply\Backend\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Dply\Backend\Models\Taxonomy;
use Dply\CMS\Repositories\BaseRepository;
use Dply\CMS\Repositories\Exceptions\RepositoryException;

interface TaxonomyRepository extends BaseRepository
{
    public function findBySlug(string $slug): null|Taxonomy;

    /**
     * @param  int  $limit
     * @return LengthAwarePaginator
     * @throws RepositoryException
     */
    public function frontendListPaginate(int $limit): LengthAwarePaginator;

    public function frontendDetail(string $slug): ?Taxonomy;
}
