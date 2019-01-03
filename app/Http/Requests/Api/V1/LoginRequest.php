<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\DefaultApiRequest;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends DefaultApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * @param Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        parent::failedValidation($validator);
    }
}
