<?php

namespace App\Http\Controllers;

use App\Filters\RoleFilter;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RolesResource;
use App\Models\Role;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleController extends Controller
{
    /**
     * @OA\Get (path="/role", tags={"Role"}, security={{ "Bearer":{} }},
     *     @OA\Parameter (name="description", in="query", required=false),
     *     @OA\Parameter (name="page", in="query", required=false, example=1, @OA\Schema(type="integer")),
     *     @OA\Parameter (name="limit", in="query", required=false, example=15, @OA\Schema(type="integer")),
     *     @OA\Response (response="200", description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/RolesResource"))
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     *
     * @param RoleFilter $filter
     * @return JsonResource
     */
    public function index (RoleFilter $filter): JsonResource {
        can('role_index');
        return RolesResource::collection($this->paginate(Role::filter($filter)));
    }

    /**
     * @OA\Post(path="/role", tags={"Role"}, security={{ "Bearer":{} }},
     *      @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RoleRequest")
     *      ),
     *      @OA\Response(response=201, description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/RolesResource")
     *      ),
     *      @OA\Response(response=400, description="Bad Request"),
     *      @OA\Response(response=422, description="Unprocessable Entity"),
     *      @OA\Response(response=401, description="Unauthenticated"),
     *      @OA\Response(response=403, description="Forbidden")
     * )
     *
     * @param RoleRequest $request
     * @return JsonResource
     */
    public function store(RoleRequest $request): JsonResource
    {
        can('role_store');
        $role = Role::create($request->all());
        $this->syncPermissions($role, $request);
        return RolesResource::make($role);
    }

    /**
     *
     * @OA\Get(path="/role/{id}", tags={"Role"}, security={{ "Bearer":{} }},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/RolesResource")
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
        can('role_show');
        return RolesResource::make($this->getRole($id));
    }

    /**
     * @OA\Put(path="/role/{id}", tags={"Role"}, security={{ "Bearer":{} }},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RoleRequest")
     *     ),
     *     @OA\Response(response=200, description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/RolesResource")
     *     ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=422, description="Unprocessable Entity")
     * )
     *
     * @param RoleRequest $request
     * @param int $id
     * @return JsonResource
     */
    public function update(RoleRequest $request, int $id): JsonResource
    {
        can('role_update');
        $role = $this->getRole($id);
        $role->update($request->all());
        $this->syncPermissions($role, $request);

        return RolesResource::make($role);
    }

    /**
     * @OA\Delete(path="/role/{id}", tags={"Role"}, security={{ "Bearer":{} }},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response (response="200", description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/RolesResource"))
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
        can('role_destroy');
        $role = $this->getRole($id);
        $role->delete();
        return RolesResource::collection($this->paginate(Role::query()));
    }

    /**
     * @param Role $role
     * @param RoleRequest $request
     * @return array
     */
    private function syncPermissions (Role $role, RoleRequest $request)
    {
        return $role->permissions()->sync($request->json('permissions.*.id'));
    }

    /**
     * @param int $id
     * @return Role
     */
    private function getRole (int $id): Role
    {
        return Role::findOrFail($id);
    }
}
