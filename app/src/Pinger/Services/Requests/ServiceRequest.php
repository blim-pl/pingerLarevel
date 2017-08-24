<?php

namespace Pinger\Services\Requests;

use CMS\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'url'   => 'required|max:255|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w\.-\?=&]*)*\/?$/',
            'valid_method'=> 'required',
            'expects' => 'required',
            'emails' => 'required'
        ];

        return parent::checkRules($rules, $this->service);
    }
}
