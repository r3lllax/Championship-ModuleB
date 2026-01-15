<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            /** @var User $user */
            $user = auth()->user();

            return response()->json([
                'token'=>$user->createToken('api')->plainTextToken,
            ]);
        }
        return response()->json([
            'message'=>'Forbidden for you'
        ],403);
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
