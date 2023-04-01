<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            return response()->json(['token' => $accessToken], 200);
        } else {

            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->User()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sessão finalizada com sucesso.'
        ]);
    }
}
