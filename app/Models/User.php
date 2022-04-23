<?php

namespace App\Models;

use App\Traits\HasPermissionsTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;
use Leandreaci\Filterable\Filterable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @OA\Schema()
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory, Filterable;
    use HasPermissionsTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
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
    private $name;

    /**
     * @OA\Property(format="email")
     * @var string
     */
    private $email;

    /**
     * @OA\Property(format="password")
     * @var string
     */

    /**
     * @OA\Property(property="roles", type="array",
     *     @OA\Items(ref="#/components/schemas/Role")
     * )
     * @return BelongsToMany
     */
    public function roles () {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
