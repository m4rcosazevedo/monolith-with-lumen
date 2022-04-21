<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Leandreaci\Filterable\QueryFilter;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CrudController extends Controller
{
    protected string $model = '';
    protected string $resource = '';
    protected string $filter = '';

    public function index(): AnonymousResourceCollection
    {
        $request = request();

        return $this->resourceFactory()->collection(
            $this->modelFactory()
                ->filter($this->filterFactory())
                ->paginate($request->has('limit') ? $request->limit : 15)
        );
    }

    public function show($id): JsonResource
    {
        return $this->resourceFactory()->make(
            $this->modelFactory()->findOrFail($id)
        );
    }

    public function store(Request $request): JsonResource
    {
        $this->validate($request, [
            'title' => 'required|max:64'
        ]);

        $model = $this->modelFactory()->create($request->only('title'));

        return $this->resourceFactory()->make($model);
    }

    public function destroy($id)
    {
        $model = $this->modelFactory()->findOrFail($id);
        $model->delete();
        return $this->resourceFactory()->collection(
            $model->paginate()
        );
    }

    public function modelFactory(): Model
    {
        return $this->factory($this->model)
            ->newInstance();
    }

    public function filterFactory(): QueryFilter
    {
        return $this->factory($this->filter)
            ->newInstance(request());
    }

    public function resourceFactory(): JsonResource
    {
        return $this->factory($this->resource)
            ->newInstanceWithoutConstructor();
    }

    private function factory(string $name): \ReflectionClass
    {
        return new \ReflectionClass($name);
    }
}
