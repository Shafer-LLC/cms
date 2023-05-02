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
use Dply\CMS\Contracts\GlobalDataContract;

/**
 * @method static void set($key, $value)
 * @method static void push($key, $value)
 * @method static void registerAction(array $actions)
 * @method static void initAction()
 * @method static mixed get($key)
 * @see \Juzaweb\CMS\Support\GlobalData
 */
class GlobalData extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return GlobalDataContract::class;
    }
}
