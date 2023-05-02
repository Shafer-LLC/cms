<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

namespace Dply\CMS\Facades;

use Illuminate\Support\Facades\Facade;
use Dply\CMS\Contracts\XssCleanerContract;

/**
 * @method static string clean(string $value)
 *
 * @see \Juzaweb\CMS\Support\XssCleaner
 */
class XssCleaner extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return XssCleanerContract::class;
    }
}
