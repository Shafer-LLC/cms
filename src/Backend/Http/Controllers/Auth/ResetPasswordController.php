<?php

namespace Dply\Backend\Http\Controllers\Auth;

use Dply\CMS\Http\Controllers\Controller;
use Dply\CMS\Traits\Auth\AuthResetPassword;

class ResetPasswordController extends Controller
{
    use AuthResetPassword;
}
