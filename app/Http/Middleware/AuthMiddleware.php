<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Token não encontrado'
            ], 401);
        }
        
        try {
            $user = PersonalAccessToken::where('token', $token)->firstOrFail()->tokenable;
            auth()->login($user);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Token inválido ou expirado.'
            ], 401);
        }

        return $next($request);
    }
}
