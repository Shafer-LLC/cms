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

use Dply\CMS\Abstracts\ResourcePolicy;

class EmailTemplatePolicy extends ResourcePolicy
{
    protected string $resourceType = 'email_templates';
}
