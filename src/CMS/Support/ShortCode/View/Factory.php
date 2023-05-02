<?php

namespace Dply\CMS\Support\ShortCode\View;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory as IlluminateViewFactory;
use Illuminate\View\ViewFinderInterface;
use Dply\CMS\Support\ShortCode\Compilers\ShortCodeCompiler;

class Factory extends IlluminateViewFactory
{
    /**
     * Short code engine resolver
     *
     * @var ShortCodeCompiler
     */
    public $shortcode;

    /**
     * Create a new view factory instance.
     *
     * @param \Illuminate\View\Compilers\EngineResolver|EngineResolver $engines
     * @param  \Illuminate\View\ViewFinderInterface                    $finder
     * @param  \Illuminate\Events\Dispatcher                           $events
     * @param \Juzaweb\CMS\Support\ShortCode\Compilers\ShortCodeCompiler          $shortcode
     */
    public function __construct(EngineResolver $engines, ViewFinderInterface $finder, Dispatcher $events, ShortCodeCompiler $shortcode)
    {
        parent::__construct($engines, $finder, $events);
        $this->shortcode = $shortcode;
    }

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string $view
     * @param  array  $data
     * @param  array  $mergeData
     *
     * @return \Illuminate\Contracts\View\View|string|View
     */
    public function make($view, $data = [], $mergeData = [])
    {
        $path = $this->finder->find(
            $view = $this->normalizeName($view)
        );

        // Next, we will create the view instance and call the view creator for the view
        // which can set any data, etc. Then we will return the view instance back to
        // the caller for rendering or performing other view manipulations on this.
        $data = array_merge($mergeData, $this->parseData($data));

        return tap(new View($this->shortcode, $this, $this->getEngineFromPath($path), $view, $path, $data), function ($view) {
            $this->callCreator($view);
        });
    }
}
