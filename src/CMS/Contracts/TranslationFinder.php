<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Dply\CMS\Contracts;

/**
 * @see \Juzaweb\CMS\Support\Translations\TranslationFinder
 */
interface TranslationFinder
{
    public function find(string $path, string $locale = 'en'): array;
}
