<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Dply\Backend\Http\Requests\User;

use Illuminate\Validation\Rule;
use Dply\CMS\Models\User;

class StoreUserRequest extends UserRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['email'] = [
            'bail',
            'required',
            'email',
            'max:150',
            Rule::modelUnique(User::class, 'email')
        ];
        $rules['password'] = [
            'bail',
            'required',
            'min:6',
            'max:32',
        ];
        return $rules;
    }
}
