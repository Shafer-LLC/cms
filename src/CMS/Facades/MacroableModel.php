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

use Dply\CMS\Contracts\MacroableModelContract;
use Illuminate\Support\Facades\Facade;

class MacroableModel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MacroableModelContract::class;
    }
}
