<?php

namespace BinshopsBlog\Events;

use BinshopsBlog\Models\BinshopsCategory;
use BinshopsBlog\Models\BinshopsCategoryTranslation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryAdded
 */
class CategoryAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var BinshopsCategory */
    public $binshopsCategory;

    public $binshopsCategoryTranslation;

    /**
     * CategoryAdded constructor.
     */
    public function __construct(BinshopsCategory $binshopsCategory, BinshopsCategoryTranslation $binshopsCategoryTranslation)
    {
        $this->binshopsCategory = $binshopsCategory;
        $this->binshopsCategoryTranslation = $binshopsCategoryTranslation;
    }
}
