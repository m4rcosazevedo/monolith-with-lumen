<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Leandreaci\Filterable\Filterable;

/**
 * @OA\Schema()
 */
class Permission extends Model
{
    use Filterable;

    protected $fillable = [
        'description',
        'permission',
    ];

    /**
     * @OA\Property(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @OA\Property()
     * @var string
     */
    private $description;

    /**
     * @OA\Property()
     * @var string
     */
    private $permission;

    /**
     * @OA\Property(format="date-time")
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(format="date-time")
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @OA\Property(property="roles", type="array",
     *     @OA\Items(ref="#/components/schemas/Role")
     * )
     * @return BelongsToMany
     */
    public function roles () {
        return $this->belongsToMany(Role::class);
    }
}
