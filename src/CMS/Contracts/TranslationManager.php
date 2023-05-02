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

use Illuminate\Support\Collection;
use Dply\CMS\Models\Translation;
use Dply\CMS\Support\Translations\TranslationExporter;
use Dply\CMS\Support\Translations\TranslationImporter;
use Dply\CMS\Support\Translations\TranslationLocale;
use Dply\CMS\Support\Translations\TranslationTranslate;

/**
 * @see \Juzaweb\CMS\Support\Manager\TranslationManager
 */
interface TranslationManager
{
    public function find(string|Collection $module, string $name = null): Collection;

    /**
     * @see \Juzaweb\CMS\Support\Manager\TranslationManager::import()
     */
    public function import(string $module, string $name = null): TranslationImporter;

    public function translate(
        string $source,
        string $target,
        string $module = 'cms',
        string $name = 'core'
    ): TranslationTranslate;

    public function export(string $module = 'cms', string $name = null): TranslationExporter;

    public function locale(string|Collection $module, string $name = null): TranslationLocale;

    public function modules(): Collection;

    /**
     * @see \Juzaweb\CMS\Support\Manager\TranslationManager::importTranslationLine()
     */
    public function importTranslationLine(array $data): Translation;
}
