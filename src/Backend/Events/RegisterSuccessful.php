<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

namespace Dply\Backend\Events;

use Dply\CMS\Models\User;

class RegisterSuccessful
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
