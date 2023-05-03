<?php

namespace BinshopsBlog\Events;

use BinshopsBlog\Models\BinshopsComment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class CommentWillBeDeleted
 */
class CommentWillBeDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var BinshopsComment */
    public $comment;

    /**
     * CommentWillBeDeleted constructor.
     */
    public function __construct(BinshopsComment $comment)
    {
        $this->comment = $comment;
    }
}
