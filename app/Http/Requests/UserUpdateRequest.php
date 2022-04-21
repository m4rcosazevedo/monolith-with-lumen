<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

/**
 * @OA\Schema()
 */
class UserUpdateRequest extends FormRequest
{

    /**
     * @OA\Property(format="string", property="name")
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
