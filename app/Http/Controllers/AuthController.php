<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');
        $token = auth()->attempt($credentials);
        if (!$token) {
            return response()->json([
                "success" => false,
                'message' => 'Informations de connexion invalides'
            ], 401);
        }

        $user = auth()->user();
        return response()->json([
            "success" => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'expires_in' => env('JWT_TTL') * 60 . " Seconds",
        ], 200);
    }
    public function logout()
    {
        auth()->logout();
        return response()->json([
            "success" => true,
            "message" => "Déconnexion réussie"
        ], 200);
    }
    public function refreshToken()
    {
        $token = auth()->refresh();

        return response()->json([
            "success" => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => auth()->user(),
            'expires_in' => env('JWT_TTL') * 60 . " Seconds",
        ]);
    }
}
