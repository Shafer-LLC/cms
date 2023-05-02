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

interface NetworkRegistionContract
{
    public function init(): void;

    public function getCurrentSiteId(): ?int;

    public function getCurrentSite(): object;

    public function isRootSite($domain = null): bool;

    public function getCurrentDomain(): string;
}
