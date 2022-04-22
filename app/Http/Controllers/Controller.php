<?php

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="0.0.1",
     *      title="Account Documentation",
     *      @OA\Contact(email="marcos.workspace@gmail.com", name="Marcos Azevedo")
     * )
     */

    /**
     * @param $model
     * @return mixed
     */
    public function paginate ($model)
    {
        $request = request();

        return $model->paginate(
            $request->has('limit') ? $request->limit : config('database.paginate.limit')
        );
    }
}
