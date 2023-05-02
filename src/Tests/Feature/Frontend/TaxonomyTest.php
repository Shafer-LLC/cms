<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

namespace Dply\Tests\Feature\Frontend;

use Dply\Backend\Models\Taxonomy;
use Dply\CMS\Facades\HookAction;
use Dply\Tests\TestCase;

class TaxonomyTest extends TestCase
{
    public function testTaxonomy()
    {
        $taxonomies = HookAction::getTaxonomies();
        foreach ($taxonomies as $types) {
            foreach ($types as $key => $taxonomy) {
                $data = Taxonomy::where('taxonomy', '=', $key)
                    ->first();
                if (empty($data)) {
                    continue;
                }

                $permalink = HookAction::getPermalinks($key);
                $base = $permalink->get('base');

                $url = "/{$base}/{$data->slug}";
                $response = $this->get($url);

                $this->printText("Test {$url}");

                $response->assertStatus(200);
            }
        }
    }
}
