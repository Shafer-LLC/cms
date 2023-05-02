<?php

namespace Dply\Backend\Http\Controllers\Auth;

use Dply\CMS\Http\Controllers\Controller;
use Dply\CMS\Traits\Auth\AuthForgotPassword;

class ForgotPasswordController extends Controller
{
    use AuthForgotPassword;
}
