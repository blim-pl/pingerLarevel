<?php

namespace App\Http\Requests\Admin;

use CMS\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email' => ['required', 'unique:users'],
            'password' => ['confirmed']
        ];

        return parent::checkRules($rules, $this->user);
    }
}
