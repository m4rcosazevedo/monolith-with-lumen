<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UsersResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    /**
     * @OA\Get (path="/user", tags={"User"},
     *     @OA\Parameter (name="name", in="query", required=false),
     *     @OA\Parameter (name="email", in="query", required=false),
     *     @OA\Parameter (name="page", in="query", required=false, example=1, @OA\Schema(type="integer")),
     *     @OA\Parameter (name="limit", in="query", required=false, example=15, @OA\Schema(type="integer")),
     *     @OA\Response (response="200", description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/UsersResource"))
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     *
     * @param UserFilter $filter
     * @return JsonResource
     */
    public function index (UserFilter $filter): JsonResource {
        return UsersResource::collection($this->paginate(User::filter($filter)));
    }

    /**
     * @OA\Post(path="/user", tags={"User"},
     *      @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserStoreRequest")
     *      ),
     *      @OA\Response(response=201, description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UsersResource")
     *      ),
     *      @OA\Response(response=400, description="Bad Request"),
     *      @OA\Response(response=422, description="Unprocessable Entity"),
     *      @OA\Response(response=401, description="Unauthenticated"),
     *      @OA\Response(response=403, description="Forbidden")
     * )
     *
     * @param UserStoreRequest $request
     * @return JsonResource
     */
    public function store(UserStoreRequest $request): JsonResource
    {
        $params = $request->validated();

        $user = User::create([
            "name" => $params['name'],
            "email"     => $params['email'],
            "password"  => $params['password']
        ]);
        $this->syncRoles($user, $request);
        return UsersResource::make($user);
    }

    /**
     *
     * @OA\Get(path="/user/{id}", tags={"User"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/UsersResource")
     *     ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Resource Not Found")
     * )
     *
     * @param int $id
     * @return JsonResource
     */
    public function show(int $id): JsonResource
    {
        return UsersResource::make($this->getUser($id));
    }

    /**
     * @OA\Put(path="/user/{id}", tags={"User"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserUpdateRequest")
     *     ),
     *     @OA\Response(response=200, description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/UsersResource")
     *     ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=422, description="Unprocessable Entity")
     * )
     *
     * @param UserUpdateRequest $request
     * @param int $id
     * @return JsonResource
     */
    public function update(UserUpdateRequest $request, int $id): JsonResource
    {
        $user = $this->getUser($id);

        $params = $request->validated();
        $user->update([
            "name" => $params['name']
        ]);
        $this->syncRoles($user, $request);

        return UsersResource::make($user);
    }

    /**
     * @OA\Delete(path="/user/{id}", tags={"User"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response (response="200", description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/UsersResource"))
     *     ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Resource Not Found")
     * )
     *
     * @param int $id
     * @return AnonymousResourceCollection
     */
    public function destroy (int $id)
    {
        $user = $this->getUser($id);
        $user->delete();
        return UsersResource::collection($this->paginate(User::query()));
    }

    /**
     * @param User $user
     * @param UserStoreRequest|UserUpdateRequest $request
     * @return array
     */
    private function syncRoles (User $user, UserStoreRequest|UserUpdateRequest $request)
    {
        return $user->roles()->sync($request->json('roles.*.id'));
    }

    /**
     * @param int $id
     * @return User
     */
    private function getUser (int $id): User
    {
        return User::findOrFail($id);
    }
}
