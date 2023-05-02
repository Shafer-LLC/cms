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

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use Dply\CMS\Contracts\ConfigContract;

/**
 * @method static \Juzaweb\CMS\Models\Config setConfig($key, $value)
 * @method static string|array getConfig($key, $default = null)
 * @method static Collection all()
 * @see \Juzaweb\CMS\Support\Config
 */
class Config extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ConfigContract::class;
    }
}
