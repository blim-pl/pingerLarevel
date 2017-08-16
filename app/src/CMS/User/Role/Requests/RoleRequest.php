<?php

namespace CMS\User\Role\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'title' => 'required|unique:roles'
        ];

        if ($this->method() == 'PATCH') {
            $rules['title'] .= ',id,' . $this->get('id');
        }

        return $rules;
    }
}
