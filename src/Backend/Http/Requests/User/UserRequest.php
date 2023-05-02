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

use Illuminate\Foundation\Http\FormRequest;
use Dply\CMS\Models\User;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        $allStatus = array_keys(User::getAllStatus());

        return [
            'name' => [
                'bail',
                'required',
                'min:5',
            ],
            'avatar' => 'nullable|string|max:150',
            'status' => 'required|in:' . implode(',', $allStatus),
        ];
    }
}
