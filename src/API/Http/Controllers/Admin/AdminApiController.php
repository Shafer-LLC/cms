<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Dply\API\Http\Controllers\Admin;

use Dply\CMS\Abstracts\Action;
use Dply\CMS\Http\Controllers\ApiController;

class AdminApiController extends ApiController
{
    public function callAction($method, $parameters): \Symfony\Component\HttpFoundation\Response
    {
        do_action(Action::BACKEND_CALL_ACTION, $method, $parameters);

        return parent::callAction($method, $parameters);
    }
}
