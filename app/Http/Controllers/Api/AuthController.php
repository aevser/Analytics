<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests as Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Requests\AuthRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json('Неверные данные', Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();
        $token = $user->createToken('user_token')->plainTextToken;

        return response()->json(['name' => $request->name, 'token' => $token], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        return response()->json('Пользователь успешно вышел', Response::HTTP_OK);
    }
}
