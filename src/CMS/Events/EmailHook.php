<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailHook
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $hook;
    public $args = [];

    public function __construct($hook, $args = [])
    {
        $this->hook = $hook;
        $this->args = $args;
    }
}
