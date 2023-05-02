<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

namespace Dply\Backend\Events;

use Dply\Backend\Models\Post;

class PostViewed
{
    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
