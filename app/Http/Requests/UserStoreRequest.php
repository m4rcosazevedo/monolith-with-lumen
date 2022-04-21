<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

/**
 * @OA\Schema()
 */
class UserStoreRequest extends FormRequest
{

    /**
     * @OA\Property(format="string", property="name")
     * @OA\Property(format="email", property="email")
     * @OA\Property(format="password", property="password")
     * @OA\Property(format="password", property="password_confirmation")
     * @OA\Property(type="array", property="roles",
     *     @OA\Items(
     *         type="object",
     *         @OA\Property(type="integer", property="id")
     *     )
     * )
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:60',
            'email' => 'required|email|max:64|unique:users',
            'password' => [
                'required',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'string',
                'min:8',
                'max:32',
                'required_with:password_confirmation',
                'same:password_confirmation'
            ],
            'password_confirmation'=>'required|same:password',
            'roles' => 'required|array',
            'roles.*.id' => 'required|exists:roles,id'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.'
        ];
    }
}
