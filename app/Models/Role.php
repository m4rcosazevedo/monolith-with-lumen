<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Leandreaci\Filterable\Filterable;

/**
 * @OA\Schema()
 */
class Role extends Model
{
    use Filterable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'description',
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
     * @OA\Property(property="permissions", type="array",
     *     @OA\Items(ref="#/components/schemas/Permission")
     * )
     * @return BelongsToMany
     */
    public function permissions () {
        return $this->belongsToMany(Permission::class);
    }

    public function users () {
        return $this->belongsToMany(User::class);
    }
}
