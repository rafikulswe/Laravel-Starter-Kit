<?php

namespace App\Validators;

use Illuminate\Http\Request;

class ExampleValidator extends BaseValidator
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch ($this->request->method()) {
            case 'GET':
                # code...
                break;
            case 'POST':
                return [
                    'title' => 'required',
                ];
                break;
            case 'PATCH':
                return [
                    'title' => 'required'
                ];
                break;
            case 'PUT':
                return [
                    'title' => 'required'
                ];
                break;
            case 'DELETE':
                # code...
                break;

            default:
                # code...
                break;
        }
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The Title field is required',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Title'
        ];
    }
}
