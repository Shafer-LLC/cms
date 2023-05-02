<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Dply\Network\Contracts;

use Juzaweb\CMS\Models\User;

interface NetworkSiteContract
{
    public function getLoginUrl(User $user): string;
}
