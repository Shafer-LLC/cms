<?php

namespace BinshopsBlog\Events;

use BinshopsBlog\Models\BinshopsCategory;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryWillBeDeleted
 */
class CategoryWillBeDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var BinshopsCategory */
    public $binshopsBlogCategory;

    /**
     * CategoryWillBeDeleted constructor.
     */
    public function __construct(BinshopsCategory $binshopsBlogCategory)
    {
        $this->binshopsBlogCategory = $binshopsBlogCategory;
    }
}
