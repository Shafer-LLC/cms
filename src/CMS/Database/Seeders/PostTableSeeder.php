<?php

namespace Dply\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Dply\Backend\Models\Post;
use Dply\Backend\Models\Taxonomy;

class PostTableSeeder extends Seeder
{
    public function run()
    {
        Post::factory(20)->create()->each(
            function ($item) {
                $categories = Taxonomy::where('taxonomy', '=', 'categories')
                    ->where('post_type', '=', 'posts')
                    ->inRandomOrder()
                    ->limit(3);

                $tags = Taxonomy::where('taxonomy', '=', 'tags')
                    ->where('post_type', '=', 'posts')
                    ->inRandomOrder()
                    ->limit(5);

                $item->syncTaxonomies(
                    [
                        'categories' => $categories->pluck('id')->toArray(),
                        'tags' => $tags->pluck('id')->toArray()
                    ]
                );
            }
        );
    }
}
