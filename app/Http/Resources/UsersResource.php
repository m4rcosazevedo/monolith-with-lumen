<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UsersResource
 * @package App\Http\Resources
 * @OA\Schema()
 */
class UsersResource extends JsonResource
{
    /**
     * @OA\Property(format="int64", property="id"),
     * @OA\Property(format="string", property="name")
     * @OA\Property(format="email", property="email")
     * @OA\Property(format="date-time", property="createdAt")
     * @OA\Property(format="date-time", property="updatedAt")
     * @OA\Property(type="array", @OA\Items(type="object", ref="#/components/schemas/RolesResource"), property="roles")
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'roles' => RolesResource::collection($this->roles),
        ];
    }
}
