<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        return response()->json([
            'token' => 'fake-token',
            'user' => $user
        ]);
    }

    public function profile()
    {
        return response()->json(['message' => 'Perfil']);
    }

    public function logout()
    {
        return response()->json(['message' => 'Logout']);
    }
}