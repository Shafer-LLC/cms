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

use Dply\Network\Models\Site;

interface SiteCreaterContract
{
    public function create(string $subdomain, array $args = []): Site;

    public function setupSite(Site $site);
}
