<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

/**
 * @OA\Schema()
 */
class AuthLoginRequest extends FormRequest
{
    /**
     * @OA\Property(format="email", property="email")
     * @OA\Property(format="password", property="password")
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.'
        ];
    }
}
