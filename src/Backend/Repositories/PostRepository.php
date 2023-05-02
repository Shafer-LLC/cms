<?php

namespace Dply\Backend\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Dply\Backend\Models\Post;
use Dply\Backend\Models\Taxonomy;
use Dply\CMS\Repositories\BaseRepository;
use Dply\CMS\Repositories\Exceptions\RepositoryException;

/**
 * Interface PostRepository.
 *
 * @package namespace Dply\Backend\Repositories;
 */
interface PostRepository extends BaseRepository
{
    public function create(array $attributes);

    public function update(array $attributes, $id);

    public function findBySlug(string $slug, $fail = true): null|Post;

    public function frontendListByTaxonomyPaginate(int $limit, int $taxonomy, ?int $page = null): LengthAwarePaginator;

    /**
     * @param  int  $limit
     * @return LengthAwarePaginator
     * @throws RepositoryException
     */
    public function frontendListPaginate(int $limit): LengthAwarePaginator;

    public function createSelectFrontendBuilder(): Builder|Taxonomy;

    public function createFrontendDetailBuilder(): Builder;

    public function getStatuses(string $type = 'posts'): array;
}
