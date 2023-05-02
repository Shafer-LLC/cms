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
use Dply\Backend\Http\Resources\UserResource;
use Dply\CMS\Http\Controllers\ApiController;

class UserController extends ApiController
{
    public function profile(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
