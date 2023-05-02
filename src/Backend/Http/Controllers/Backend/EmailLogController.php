<?php

namespace Dply\Backend\Http\Controllers\Backend;

use Dply\CMS\Http\Controllers\BackendController;
use Dply\Backend\Http\Datatables\EmailLogDatatable;

class EmailLogController extends BackendController
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $dataTable = new EmailLogDatatable();
        $title = trans('cms::app.email_logs');

        return view(
            'cms::backend.logs.email',
            compact(
                'title',
                'dataTable'
            )
        );
    }
}
