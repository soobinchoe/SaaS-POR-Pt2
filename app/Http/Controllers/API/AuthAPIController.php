<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAPIRequest;
use App\Http\Requests\RegisterAPIRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthAPIController extends Controller
{
    /**
     *
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register new user",
     *     @OA\Parameter(name="given_name", in="query", description="given name of the user", @OA\Schema(type="string")),
     *     @OA\Parameter(name="family_name", in="query", description="family name of the user", @OA\Schema(type="string")),
     *     @OA\Parameter(name="email", in="query", description="email address of the user", @OA\Schema(type="string")),
     *     @OA\Parameter(name="password", in="query", description="password of the user", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Successfully Register new User")
     * )
     */
    public function register(RegisterAPIRequest $request)
    {

        $post_data = $request->validated();

        $user = User::create([
            'given_name' => $post_data['given_name'],
            'family_name' => $post_data['family_name'],
            'email' => $post_data['email'],
            'password' => Hash::make($post_data['password']),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     *
     * @OA\Post(
     *     path="/api/login",
     *     summary="login user",
     *     @OA\Parameter(name="email", in="query", description="email address of the user", @OA\Schema(type="string")),
     *     @OA\Parameter(name="password", in="query", description="password of the user", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Successfully logged in"),
     *     @OA\Response(response="401", description="Login information is invalid.")
     * )
     */
    public function login(LoginAPIRequest $request)
    {
        $post_data = $request->validated();

        if (!\Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json([
                    'message' => 'Login information is invalid.'
                ], 401);
        }

        $user = User::where('email', $post_data['email'])->firstOrFail();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     *
     * @OA\Post(
     *     path="/api/logout",
     *     summary="logout user - Needs Futher testing",
     *     security={ {"bearer": {} }},
     *     @OA\Parameter(name="access_token", in="header", description="email address of the user", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Successfully logged out the User")
     * )
     */
    public function logout(Request $request){
        auth()->user()->currentAccessToken()->delete();

        return [
            'message'=>'Logged out'
        ];
    }
}
