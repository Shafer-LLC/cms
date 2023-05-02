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

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Dply\Backend\Http\Resources\TaxonomyResource;
use Dply\Backend\Repositories\TaxonomyRepository;
use Dply\CMS\Http\Controllers\ApiController;
use Dply\CMS\Repositories\Criterias\FilterCriteria;
use Dply\CMS\Repositories\Criterias\SearchCriteria;
use Dply\CMS\Repositories\Criterias\SortCriteria;

class TaxonomyController extends ApiController
{
    public function __construct(protected TaxonomyRepository $taxonomyRepository)
    {
    }

    public function index(Request $request, string $type, string $taxonomy): AnonymousResourceCollection
    {
        $queries = $request->all();
        $queries['post_type'] = $type;
        $queries['taxonomy'] = $taxonomy;

        $this->taxonomyRepository->pushCriterias(
            [
                SearchCriteria::make($queries),
                SortCriteria::make($queries),
                FilterCriteria::make($queries),
            ]
        );

        $paginate = $this->taxonomyRepository->frontendListPaginate($this->getQueryLimit($request));

        return TaxonomyResource::collection($paginate);
    }

    public function show(Request $request, string $type, string $taxonomy, string $slug):
    JsonResource
    {
        $queries = $request->all();
        $queries['post_type'] = $type;
        $queries['taxonomy'] = $taxonomy;

        $this->taxonomyRepository->pushCriteria(FilterCriteria::make($queries));

        $data = $this->taxonomyRepository->frontendDetail($slug);

        return TaxonomyResource::make($data);
    }
}
