<?php

namespace App\Http\Controllers\Auth;

use App\Data\Auth\LoginData;
use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\JsonResponse;
use Str;

class AuthController extends Controller
{
    public function login(LoginData $loginData): JsonResponse
    {

        $user = User::where('email', $loginData->email)->first();
        if (! $user || ! Hash::check($loginData->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials',
            ], 401);
        }
        $token = $user->createToken(Str::random().$user->email)->plainTextToken;

        return response()->json([
            'access_token' => $token,
        ]);
    }
}
