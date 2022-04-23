<?php

namespace App\Http\Controllers;

use App\Filters\PermissionFilter;
use App\Http\Requests\PermissionStoreRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Http\Resources\PermissionsResource;
use App\Models\Permission;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionController extends Controller
{
    /**
     * @OA\Get (path="/permission", tags={"Permission"}, security={{ "Bearer":{} }},
     *     @OA\Parameter (name="description", in="query", required=false),
     *     @OA\Parameter (name="permission", in="query", required=false),
     *     @OA\Parameter (name="page", in="query", required=false, example=1, @OA\Schema(type="integer")),
     *     @OA\Parameter (name="limit", in="query", required=false, example=15, @OA\Schema(type="integer")),
     *     @OA\Response (response="200", description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/PermissionsResource"))
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     *
     * @param PermissionFilter $filter
     * @return JsonResource
     */
    public function index (PermissionFilter $filter): JsonResource {
        can('permission_index');
        return PermissionsResource::collection(
            $this->paginate(Permission::filter($filter))
        );
    }

    /**
     * @OA\Post(path="/permission", tags={"Permission"}, security={{ "Bearer":{} }},
     *      @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PermissionStoreRequest")
     *      ),
     *      @OA\Response(response=201, description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PermissionsResource")
     *      ),
     *      @OA\Response(response=400, description="Bad Request"),
     *      @OA\Response(response=422, description="Unprocessable Entity"),
     *      @OA\Response(response=401, description="Unauthenticated"),
     *      @OA\Response(response=403, description="Forbidden")
     * )
     *
     * @param PermissionStoreRequest $request
     * @return JsonResource
     */
    public function store(PermissionStoreRequest $request): JsonResource
    {
        can('permission_store');
        return PermissionsResource::make(Permission::create($request->all()));
    }

    /**
     *
     * @OA\Get(path="/permission/{id}", tags={"Permission"}, security={{ "Bearer":{} }},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PermissionsResource")
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
        can('permission_show');
        return PermissionsResource::make($this->getPermission($id));
    }

    /**
     * @OA\Put(path="/permission/{id}", tags={"Permission"}, security={{ "Bearer":{} }},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PermissionUpdateRequest")
     *     ),
     *     @OA\Response(response=200, description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PermissionsResource")
     *     ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=422, description="Unprocessable Entity")
     * )
     *
     * @param PermissionUpdateRequest $request
     * @param int $id
     * @return JsonResource
     */
    public function update(PermissionUpdateRequest $request, int $id): JsonResource
    {
        can('permission_update');
        $permission = $this->getPermission($id);
        $permission->update($request->all());

        return PermissionsResource::make($permission);
    }

    /**
     * @OA\Delete(path="/permission/{id}", tags={"Permission"}, security={{ "Bearer":{} }},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response (response="200", description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/PermissionsResource"))
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
        can('permission_destroy');
        $permission = $this->getPermission($id);
        $permission->delete();
        return PermissionsResource::collection($this->paginate(Permission::query()));
    }

    /**
     * @param int $id
     * @return Permission
     */
    private function getPermission (int $id): Permission
    {
        return Permission::findOrFail($id);
    }
}
