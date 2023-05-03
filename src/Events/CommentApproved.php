<?php

namespace BinshopsBlog\Events;

use BinshopsBlog\Models\BinshopsComment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class CommentApproved
 */
class CommentApproved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var BinshopsComment */
    public $comment;

    /**
     * CommentApproved constructor.
     */
    public function __construct(BinshopsComment $comment)
    {
        $this->comment = $comment;
        // you can get the blog post via $comment->post
    }
}
