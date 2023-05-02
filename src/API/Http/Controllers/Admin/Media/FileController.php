<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    GNU General Public License v2.0
 */

namespace Dply\API\Http\Controllers\Admin\Media;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Dply\Backend\Repositories\MediaFileRepository;
use Dply\CMS\Http\Controllers\ApiController;
use Dply\CMS\Repositories\Criterias\FilterCriteria;
use Dply\CMS\Repositories\Criterias\SearchCriteria;
use Dply\CMS\Repositories\Criterias\SortCriteria;

class FileController extends ApiController
{
    public function __construct(protected MediaFileRepository $fileRepository)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $queries = $request->all();
        $this->fileRepository->pushCriteria(new SearchCriteria($queries));
        $this->fileRepository->pushCriteria(new FilterCriteria($queries));
        $this->fileRepository->pushCriteria(new SortCriteria($queries));

        $results = $this->fileRepository->paginate($this->getQueryLimit($request));

        return $this->restPaginate($results);
    }
}
