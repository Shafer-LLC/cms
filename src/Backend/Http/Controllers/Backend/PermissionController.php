<?php

namespace Dply\Backend\Http\Controllers\Backend;

use Dply\CMS\Http\Controllers\BackendController;

class PermissionController extends BackendController
{
    public function index()
    {
        //

        return view('jupe::index', [
            'title' => 'Title Page',
        ]);
    }
}
