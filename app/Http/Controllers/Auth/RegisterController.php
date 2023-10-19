<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return  view('auth.register');
    }

    public function handle()
    {
        request()->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5']
        ], [
            'username.required' => 'A username is required.',
            'username.unique' => 'This username is already taken.',
            'password.required' => 'A password is required.',
            'password.min' => 'Your password must be at least 5 characters long.',
        ]);

        $user = User::create([
            'username' => request('username'),
            'password' => Hash::make(request('password'))
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->to(RouteServiceProvider::HOME);
    }
}
