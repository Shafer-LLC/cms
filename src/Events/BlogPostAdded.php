<?php

namespace BinshopsBlog\Events;

use BinshopsBlog\Models\BinshopsPost;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class BlogPostAdded
 */
class BlogPostAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var BinshopsPost */
    public $binshopsBlogPost;

    /**
     * BlogPostAdded constructor.
     */
    public function __construct(BinshopsPost $binshopsBlogPost)
    {
        $this->binshopsBlogPost = $binshopsBlogPost;
    }
}
