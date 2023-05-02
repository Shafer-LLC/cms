<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Dply\Network\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Dply\CMS\Abstracts\DataTable;
use Dply\CMS\Http\Controllers\BackendController;
use Dply\CMS\Traits\ResourceController;
use Dply\Network\Contracts\SiteManagerContract;
use Dply\Network\Http\Datatables\SiteDatatable;
use Dply\Network\Models\Site;

class SiteController extends BackendController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected SiteManagerContract $siteManager;

    protected string $viewPrefix = 'network::site';

    public function __construct(
        SiteManagerContract $siteManager
    ) {
        $this->siteManager = $siteManager;
    }

    public function loginToken(Request $request): RedirectResponse
    {
        $user = $this->siteManager->validateLoginUrl($request->all());

        if (empty($user)) {
            abort(403, 'Login Token invalid');
        }

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }

    protected function getDataTable(...$params): DataTable
    {
        return new SiteDatatable();
    }

    protected function validator(array $attributes, ...$params): array
    {
        return [
            'domain' => [
                'bail',
                'required',
                'max:50',
                'min:4',
                "regex:/(^[a-z0-9\-]+)/",
                Rule::modelUnique(
                    Site::class,
                    'domain',
                    function ($q) {
                        $q->where('id', '!=', request()->route()->parameter('id'));
                    }
                )
            ],
        ];
    }

    protected function getModel(...$params): string
    {
        return Site::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('cms::app.network.sites');
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model, ...$params);
        $data['statuses'] = Site::getAllStatus();
        $data['mappingDomains'] = $model->domainMappings()->get();
        return $data;
    }

    protected function storeSuccess($request, $model, ...$params): void
    {
        $this->siteManager->getCreater()->setupSite($model);
    }
}
