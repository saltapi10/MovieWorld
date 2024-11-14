<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController
{

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route('dashboard')->with('status', 'Error creating user. Try again!')
                ->withErrors($validator)
                ->withInput();
        }

        // Retrieve the validated input...
        $validated = $validator->validated();

        $userArray = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password']
        ];

        $user = User::create($userArray);

        if(!$user){
            return Redirect::route('dashboard')->with('status', 'Error creating user. Try again!');
        }

        return Redirect::route('dashboard')->with('status', 'New User was created');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route('dashboard')->with('status', 'Error logging in. Try again!')
                ->withErrors($validator)
                ->withInput();
        }

        // Retrieve the validated input...
        $validated = $validator->validated();

        $authenticated = Auth::attempt(array('email' => $validated['email'], 'password' => $validated['password']));

        if (!$authenticated) {
            return Redirect::route('dashboard')->with('status', 'Wrong credentials');
        }

        $userId = Auth::id();

        $request->session()->regenerate();

        return Redirect::route('dashboard')->with('status', 'You have successfully logged in');
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::route('dashboard')->with('status', 'You have successfully logged out');
    }

}
