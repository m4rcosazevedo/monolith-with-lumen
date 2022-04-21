<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PermissionsResource
 * @package App\Http\Resources
 * @OA\Schema()
 */
class PermissionsResource extends JsonResource
{
    /**
     * @OA\Property(format="int64", property="id"),
     * @OA\Property(format="string", property="description")
     * @OA\Property(format="string", property="permission")
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'permission' => $this->permission
        ];
    }
}
