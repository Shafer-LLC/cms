<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Dply\CMS\Facades;

use Illuminate\Support\Facades\Facade;
use Dply\CMS\Contracts\GoogleTranslate as GoogleTranslateContract;

class GoogleTranslate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return GoogleTranslateContract::class;
    }
}
