<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\PersonalAccessTokenResult;
use Laravel\Passport\TokenRepository;

class AuthController extends Controller
{
    public function login(Request $request)
    {
     /*   // Validar las credenciales
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $token = $user->createToken('Token de Usuario')->accessToken;

            $userData = $user->toArray();  
            $encryptedUserData = encrypt(json_encode($userData)); 

            return response()->json([
                'token' => $token,
                'user' => $encryptedUserData 
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }*/
}
}
