<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Admin login
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {

        if (auth()->attempt($request->validated())) {
            return redirect()->route('courses');
        }

        return redirect()->back()->withErrors([
            'email'=>'Invalid email or password',
            'password'=>'Invalid email or password',
        ]);
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
            return redirect()->route('login');
        }
        dd('error');
    }
}
