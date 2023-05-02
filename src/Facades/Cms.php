<?php

namespace dply\Cms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \dply\Cms\Cms
 */
class Cms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \dply\Cms\Cms::class;
    }
}
