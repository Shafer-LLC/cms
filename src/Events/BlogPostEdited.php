<?php

namespace BinshopsBlog\Events;

use BinshopsBlog\Models\BinshopsPost;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class BlogPostEdited
 */
class BlogPostEdited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var BinshopsPost */
    public $binshopsBlogPost;

    /**
     * BlogPostEdited constructor.
     */
    public function __construct(BinshopsPost $binshopsBlogPost)
    {
        $this->binshopsBlogPost = $binshopsBlogPost;
    }
}
