<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

/**
 * @OA\Schema()
 */
class PermissionStoreRequest extends FormRequest
{

    /**
     * @OA\Property(format="string", property="description")
     * @OA\Property(format="string", property="permission")
     */
    public function rules(): array
    {
        return [
            'description' => 'required',
            'permission' => 'required|unique:permissions'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.'
        ];
    }
}
