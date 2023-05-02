<?php

namespace Dply\Backend\Http\Controllers\Backend;

use Dply\CMS\Http\Controllers\BackendController;
use Dply\Backend\Models\Post;
use Dply\CMS\Traits\PostTypeController;

class PostController extends BackendController
{
    use PostTypeController;

    protected string $viewPrefix = 'cms::backend.post';

    protected function getModel(...$params): string
    {
        return Post::class;
    }
}
