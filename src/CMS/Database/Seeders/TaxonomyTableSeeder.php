<?php

namespace Dply\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Dply\Backend\Models\Taxonomy;

class TaxonomyTableSeeder extends Seeder
{
    public function run()
    {
        Taxonomy::factory(20)->create();
    }
}
