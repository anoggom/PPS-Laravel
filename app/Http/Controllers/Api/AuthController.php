<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Cookie;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Usuario registrado correctamente',
            ], 201);
        }

        return redirect('/login');
    }

    public function login(Request $request): JsonResponse|RedirectResponse
    {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('email', 'password');

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Email o contraseña incorrectos'], 401);
        }

        if ($request->wantsJson()) {
            return $this->respondWithToken($token);
        }

        return redirect()->intended('/')->withCookie($this->buildCookie($token));
    }

    public function logout(): JsonResponse|RedirectResponse
    {
        Auth::guard('api')->logout();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Sesión cerrada correctamente']);
        }

        return redirect('/')->withoutCookie('access_token', '/');
    }

    public function refresh(): JsonResponse
    {
        try {
            $token = JWTAuth::getToken();

            if (!$token) {
                return response()->json(['error' => 'Token no proporcionado'], 400);
            }

            $newToken = JWTAuth::refresh($token);

            return $this->respondWithToken($newToken);
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Sesión expirada definitivamente'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo refrescar el token'], 500);
        }
    }

    public function me(): JsonResponse
    {
        return response()->json(Auth::guard('api')->user());
    }

    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'status' => 200,
        ])->withCookie($this->buildCookie($token));
    }

    private function buildCookie(string $token): Cookie
    {
        return cookie(
            'access_token',
            $token,
            JWTAuth::factory()->getTTL(),
            '/',
            null,
            config('app.env') !== 'local',
            true,
            false,
            Cookie::SAMESITE_LAX
        );
    }
}
