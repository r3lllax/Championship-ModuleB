<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{

    public function index()
    {
        return view('login');
    }
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
