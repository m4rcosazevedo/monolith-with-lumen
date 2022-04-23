<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Resources\UsersResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'auth:api', [
                'except' => [
                    'login'
                ]
            ]
        );
    }

    /**
     * @OA\Post (path="/auth/login", tags={"Auth"},
     *     @OA\Parameter (name="email", in="query", required=false),
     *     @OA\Parameter (name="password", in="query", required=false),
     *     @OA\Response (response="200", description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AuthResource")
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     * @param  AuthLoginRequest  $request
     * @return JsonResponse
     */
    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     *
     * @OA\Post(path="/auth/me", tags={"Auth"}, security={{ "Bearer":{} }},
     *     @OA\Response(response=200, description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/UsersResource")
     *     ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Resource Not Found")
     * )
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(UsersResource::make(auth()->user()));
    }

    /**
     *
     * @OA\Post(path="/auth/logout", tags={"Auth"}, security={{ "Bearer":{} }},
     *     @OA\Response (response="200", description="Successful operation",
     *         @OA\JsonContent(@OA\Property (property="message", example="Successfully logged out"))
     *     ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Resource Not Found")
     * )
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @OA\Post (path="/auth/refresh", tags={"Auth"}, security={{ "Bearer":{} }},
     *     @OA\Response (response="200", description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AuthResource")
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 24
        ]);
    }
}
