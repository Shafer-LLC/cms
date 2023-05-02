<?php

namespace Dply\Cms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dply\Cms\Cms
 */
class Cms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Dply\Cms\Cms::class;
    }
}
