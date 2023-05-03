<?php

namespace BinshopsBlog\Events;

use BinshopsBlog\Models\BinshopsComment;
use BinshopsBlog\Models\BinshopsPost;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class CommentAdded
 */
class CommentAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var BinshopsPost */
    public $binshopsBlogPost;

    /** @var BinshopsComment */
    public $newComment;

    /**
     * CommentAdded constructor.
     */
    public function __construct(BinshopsPost $binshopsBlogPost, BinshopsComment $newComment)
    {
        $this->binshopsBlogPost = $binshopsBlogPost;
        $this->newComment = $newComment;
    }
}
