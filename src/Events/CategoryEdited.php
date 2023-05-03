<?php

namespace BinshopsBlog\Events;

use BinshopsBlog\Models\BinshopsCategory;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryEdited
 */
class CategoryEdited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var BinshopsCategory */
    public $binshopsBlogCategory;

    /**
     * CategoryEdited constructor.
     */
    public function __construct(BinshopsCategory $binshopsBlogCategory)
    {
        $this->binshopsBlogCategory = $binshopsBlogCategory;
    }
}
