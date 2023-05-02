<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

namespace Dply\Backend\Policies;

use Juzaweb\CMS\Abstracts\ResourcePolicy;

class RolePolicy extends ResourcePolicy
{
    protected string $resourceType = 'roles';
}
