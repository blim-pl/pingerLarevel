<?php

namespace Pinger\Pages\Requests;

use CMS\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title' => 'required|max:255',
            'alias' => 'regex:/^[a-z\d\-\_]+$/|unique:pages'
        ];

        return parent::checkRules($rules, $this->page);
    }
}
