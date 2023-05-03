<?php

namespace BinshopsBlog\Events;

use BinshopsBlog\Models\BinshopsPost;
use BinshopsBlog\Models\BinshopsPostTranslation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class UploadedImage
 */
class UploadedImage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var BinshopsPost|null */
    public $binshopsBlogPost;

    public $image;

    public $source;

    public $image_filename;

    /**
     * UploadedImage constructor.
     *
     * @param $image_filename - the new filename
     * @param  BinshopsPost  $binshopsBlogPost
     * @param $source string|null  the __METHOD__  firing this event (or other string)
     */
    public function __construct(string $image_filename, $image, BinshopsPostTranslation $binshopsBlogPost = null, string $source = 'other')
    {
        $this->image_filename = $image_filename;
        $this->binshopsBlogPost = $binshopsBlogPost;
        $this->image = $image;
        $this->source = $source;
    }
}
