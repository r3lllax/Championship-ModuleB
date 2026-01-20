<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Login
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (auth()->attempt($request->only('email', 'password'))) {
            /** @var User $user */
            $user = auth()->user();

            return response()->json([
                'token'=>$user->createToken('api')->plainTextToken,
            ]);
        }
        return response()->json([
            'message'=>'Invalid data',
            'errors'=>[
                'email'=>['Invalid email or password.'],
            ]
        ],422);
    }

    /**
     * Registration
     *
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function registration(RegistrationRequest $request): JsonResponse
    {
        if (User::query()->create($request->validated())){
            return response()->json(['success'=>true],201);
        }
        return response()->json(['success'=>false],500);
    }
}
