<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Dply\CMS\Support\Manager;

use Illuminate\Support\Arr;
use Dply\Backend\Models\Post;
use Dply\Backend\Repositories\PostRepository;
use Dply\CMS\Contracts\PostManagerContract;

class PostManager implements PostManagerContract
{
    protected PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function create(array $data, array $options = []): Post
    {
        $model = $this->postRepository->create($data);

        $model->syncTaxonomies($data);

        $meta = Arr::get($data, 'meta', []);

        $model->syncMetas($meta);

        return $model;
    }

    public function update(array $data, int $id, array $options = []): Post
    {
        $model = $this->postRepository->update($data, $id);

        $model->syncTaxonomies($data);

        if ($meta = Arr::get($data, 'meta', [])) {
            $model->syncMetas($meta);
        }

        return $model;
    }
}
