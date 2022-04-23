<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="0.0.1",
     *      title="Account Documentation",
     *      @OA\Contact(email="marcos.workspace@gmail.com", name="Marcos Azevedo")
     * )
     *
     * @OA\Server (
     *      url="/"
     * )
     */

    /**
     * @OA\SecurityScheme(
     *     scheme="bearer",
     *     securityScheme="Bearer",
     *     type="http",
     *     in="header",
     *     name="Authorization",
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
