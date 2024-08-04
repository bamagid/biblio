<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function register(StoreUserRequest $request)
    {

        User::create([
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "role" => "membre",
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        return response()->json([
            "status" => true,
            "message" => "Utilisateur enregistré avec succés",

        ]);
    }

    // Login API - POST (email, password)
    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            "email" => "required|email",
            "password" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    "status" => false,
                    "errors" =>
                    $validator->errors()
                ],
                422
            );
        }

        $token = auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if (!$token) {

            return response()->json([
                "status" => false,
                "message" => "Informations de connexion invalide"
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "Utilisateur connecté avec succès",
            "token" => $token,
            "expires_in" => env("JWT_TTL") * 60 . " seconds"
        ]);
    }
    public function profile()
    {
        $userData = auth()->user();
        return response()->json([
            "status" => true,
            "message" => "Information du profil",
            "data" => $userData,
        ]);
    }
    public function refreshToken()
    {

        $token = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "Nouveau  Token JWT",
            "token" => $token,
            "expires_in" => env("JWT_TTL") * 60 . " seconds"
        ]);
    }
    public function logout()
    {

        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "Utilisateur deconnecté avec succées"
        ]);
    }
}
