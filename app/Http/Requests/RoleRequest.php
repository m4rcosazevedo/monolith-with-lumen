<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

/**
 * @OA\Schema()
 */
class RoleRequest extends FormRequest
{

    /**
     * @OA\Property(format="string", property="description")
     * @OA\Property(type="array", property="permissions",
     *     @OA\Items(
     *         type="object",
     *         @OA\Property(type="integer", property="id")
     *     )
     * )
     */
    public function rules(): array
    {
        return [
            'description' => 'required',
            'permissions' => 'required|array',
            'permissions.*.id' => 'required|exists:permissions,id'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.'
        ];
    }
}
