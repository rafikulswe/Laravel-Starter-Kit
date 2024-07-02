<?php

namespace App\Validators;

class BaseValidator
{
    protected $request;

    public function rules()
    {
        switch ($this->request->method()) {
            case 'GET':
            case 'POST':
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                return [];

            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'required'          => ':attribute is required.',
            'unique'            => 'The :attribute field already exist.',
            'string'            => 'The :attribute field must be string.',
            'integer'           => 'The :attribute field must be integer.',
            'boolean'           => 'The :attribute field must be true or false.',
            'date'              => 'The :attribute is not a valid date.',
            'url'               => 'The :attribute format is invalid.',
            'email'             => 'The :attribute field is email.',
            'digits'            => 'The :attribute must be :digits digits.',
            'numeric'           => 'The :attribute must be a number.',
            'image'             => 'The :attribute must be an image.',
            'ip'                => 'The :attribute must be a valid IP address.',
            'json'              => 'The :attribute must be a valid JSON string.',
            'min'               => 'The :attribute field has min :min character.',
            'max'               => 'The :attribute field has max :max character.',
            'exists'            => 'The :attribute field not exists in system.',
            'same'              => 'The :attribute and :other must match.',
            'size'              => 'The :attribute must be exactly :size.',
            'between'           => 'The :attribute value :input is not between :min - :max.',
            'in'                => 'The :attribute must be one of the following types: :values',
            'required_with'     => 'The :attribute field is required when :values is present.',
            'required_with_all' => 'The :attribute field is required when :values is present.',
        ];
    }

    public function attributes()
    {
        return [
            'name'   => 'Name',
            'amount' => 'Amount',
        ];
    }

}
