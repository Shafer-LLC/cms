<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

namespace Dply\API\Http\Controllers;

use Illuminate\Http\Request;
use Dply\Backend\Http\Resources\PostCollection;
use Dply\Backend\Http\Resources\PostResource;
use Dply\Backend\Repositories\PostRepository;
use Dply\CMS\Http\Controllers\ApiController;
use Dply\CMS\Repositories\Criterias\FilterCriteria;
use Dply\CMS\Repositories\Criterias\SearchCriteria;
use Dply\CMS\Repositories\Criterias\SortCriteria;

class PostController extends ApiController
{
    public function __construct(protected PostRepository $postRepository)
    {
    }

    public function index(Request $request, $type): PostCollection
    {
        $queries = $request->query();
        $queries['type'] = $type;
        $this->postRepository->pushCriteria(new SearchCriteria($queries));
        $this->postRepository->pushCriteria(new FilterCriteria($queries));
        $this->postRepository->pushCriteria(new SortCriteria($queries));

        $limit = $this->getQueryLimit($request);

        $rows = $this->postRepository->frontendListPaginate($limit);

        return new PostCollection($rows);
    }

    public function show($type, $slug): PostResource
    {
        $model = $this->postRepository->createFrontendDetailBuilder()
            ->where('type', '=', $type)
            ->where('slug', '=', $slug)
            ->firstOrFail();

        return new PostResource($model);
    }
}
