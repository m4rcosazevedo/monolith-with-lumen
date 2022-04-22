<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AuthResource
 * @package App\Http\Resources
 * @OA\Schema()
 */
class AuthResource extends JsonResource
{
    /**
     * @OA\Property(format="int64", property="access_token"),
     * @OA\Property(format="string", property="token_type")
     * @OA\Property(type="integer", property="expires_in")
     */
    public function toArray($request)
    {
        return [];
    }
}
