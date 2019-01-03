<?php

namespace App\Http\Requests\Api;

use App\Enum\HttpStatusCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

/**
 * Class DefaultApiRequest
 * @package App\Http\Requests\Api
 */
class DefaultApiRequest extends FormRequest
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
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new JsonResponse([
            'errors' => [
                'status' => HttpStatusCode::UNPROCESSABLE_ENTITY,
                'message' => $validator->errors(),
            ]], HttpStatusCode::UNPROCESSABLE_ENTITY);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}