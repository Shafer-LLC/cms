<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Dply\CMS\Support\Collections;

use Illuminate\Support\Collection;

interface XMLCollectionInterface
{
    public function getCollection($filePath): Collection;
}
