<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      tags={"User"},
     *      summary="User Login",
     *      description="Token almak için kullanıcı girişi",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"email", "password"},
     *            @OA\Property(
     *              property="email",
     *              type="string",
     *              format="string",
     *              example="email@email.com"
     *              ),
     *            @OA\Property(
     *              property="password",
     *              type="string",
     *              format="string",
     *              example="password123"
     *              ),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                property="status",
     *                type="integer",
     *                 example=""
     *                 ),
     *             @OA\Property(
     *                property="data",
     *               type="object"
     *               )
     *          )
     *       )
     *  )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
