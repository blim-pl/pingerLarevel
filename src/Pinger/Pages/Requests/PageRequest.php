<?php

namespace Pinger\Pages\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

        if ($this->method() == 'PATCH') {
            $rules['alias'] .= ',id,' . $this->get('id');
        }

        return $rules;
    }
}
