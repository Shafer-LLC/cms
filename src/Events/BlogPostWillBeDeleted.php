<?php

namespace BinshopsBlog\Events;

use BinshopsBlog\Models\BinshopsPost;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class BlogPostWillBeDeleted
 */
class BlogPostWillBeDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var BinshopsPost */
    public $binshopsBlogPost;

    /**
     * BlogPostWillBeDeleted constructor.
     */
    public function __construct(BinshopsPost $binshopsBlogPost)
    {
        $this->binshopsBlogPost = $binshopsBlogPost;
    }
}
