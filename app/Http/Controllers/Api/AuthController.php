<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
* @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     tags={"Authorization"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="User's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="role",
     *         in="query",
     *         description="User's role",
     *         required=true,
     *         schema={"type": "string", "enum": {"admin", "user"}, "default": "admin"}
     *     ),
     *     @OA\Response(response="201", description="User registered successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */

    public function register( Request $request){
        $data = $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'role' => 'in:admin,user',
        ]);

        $userData = array_merge($data, ['role' => $data['role'] ?? 'admin']);


        $user = User::create($userData);
        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Authenticate user and generate berar token",
     *     tags={"Authorization"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="User's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Wrong credentials")
     * )
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('name', $fields['name'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Wrong credentials'
            ]);
        }

        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'message' => 'logged in successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }
}
