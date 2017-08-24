<?php

namespace CMS\Http;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest as LarevelFormRequest;

class FormRequest extends LarevelFormRequest
{
    /**
     * Add ID if unique value is not changed
     * @param array $options
     * @return mixed|string
     */
    protected function extendsUnique(array $options)
    {
        if (preg_match('/unique/', $options['rule'])) {
            if($options['model'][$options['field']] == $this->request->get($options['field'])) {
                $options['rule'] .= ',id,:id';
            }
        }

        return $options['rule'];
    }

    /**
     * Fix rules. eg. add ID if editing current row
     *
     * @param array $rules
     * @param Model|null $model
     * @return array
     */
    public function checkRules(array $rules, Model $model = null)
    {
        switch ($this->method()) {
            case 'PATCH':
                $fixedRules = [];

                foreach ($rules as $field => $validations) {

                    if (!is_array($validations)) {
                        $validations = explode('|', $validations);
                    }

                    foreach ($validations as $k => $validation) {
                        $fixedRules[$field][$k] = $this->extendsUnique(['field' => $field, 'rule' => $validation, 'model' => $model]);
                    }
                }

                break;
            default:
                $fixedRules = $rules;
        }

        return $fixedRules;
    }
}
