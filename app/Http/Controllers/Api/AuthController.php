<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // 1. Validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Check credentials
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }


        $user = Auth::user();

        // 4. Create token
        $token = $user->createToken('api-token')->plainTextToken;


        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }


    public function logout(Request $request)
    {
        // current token delete
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
