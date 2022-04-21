<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RolesResource
 * @package App\Http\Resources
 * @OA\Schema()
 */
class RolesResource extends JsonResource
{
    /**
     * @OA\Property(type="integer", property="id"),
     * @OA\Property(format="string", property="description")
     * @OA\Property(format="date-time", property="createdAt")
     * @OA\Property(format="date-time", property="updatedAt")
     * @OA\Property(type="array", @OA\Items(type="object", ref="#/components/schemas/PermissionsResource"), title="Permissions", description="permissions", property="permissions")
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'permissions' => PermissionsResource::collection($this->permissions),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
