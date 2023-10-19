<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AccountAboutMes;
use App\Models\AccountUsernames;
use App\Models\AccountGames;

class MainController extends Controller
{
    public function home(Request $request)
    {
        return view('home', [
            'path' => $request->path(),
            'username' => Auth::user()->username,
        ]);
    }

    public function profile(Request $request)
    {
        $a_us = AccountUsernames::where('user_id', '=', Auth::user()->id)->get();
        $account_usernames = [];
        foreach($a_us as $a_u) {
            $account_usernames[$a_u->platform] = $a_u->username;
        }

        $account_about_me = AccountAboutMes::where('user_id', '=', Auth::user()->id)->first();

        return view('profile', [
            'path' => $request->path(),
            'username' => Auth::user()->username,
            'about_me' => $account_about_me ? $account_about_me->text : null,
            'account_usernames' => $account_usernames,
            'account_games' => AccountGames::where('user_id', '=', Auth::user()->id)->get(),
        ]);
    }

    public function settings(Request $request)
    {
        return view('settings', [
            'path' => $request->path(),
            'username' => Auth::user()->username,
        ]);
    }

    public function update_username(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
        ], [
            'username.unique' => 'This username is already taken.',
        ]);

        $user = Auth::user();

        $user->forceFill([
            'username' => $request->username,
        ])->save();

        return redirect()->route('settings')->with('username_success', 'Your username has been updated.');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:5'],
        ], [
            'new_password.min' => 'Your new password must be at least 5 characters long.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'The current password you have provided is incorrect.',
            ]);
        }

        $user->forceFill([
            'password' => Hash::make($request->new_password),
        ])->save();

        return redirect()->route('settings')->with('password_success', 'Your password has been updated.');
    }

    public function delete_user(Request $request)
    {
        $user = Auth::user();

        $user->delete();

        return redirect()->route('login');
    }

    public function update_account_about_me(Request $request)
    {
        $account_about_me = AccountAboutMes::where('user_id', '=', Auth::user()->id)->first();

        if (!$request->text && $account_about_me)
        {
            $account_about_me->delete();
            return redirect()->route('profile');
        }
        else if (!$request->text)
        {
            return redirect()->route('profile');
        }
        else if (!$account_about_me)
        {
            AccountAboutMes::create([
                'user_id' => Auth::user()->id,
                'text' => $request->text,
            ]);

            return redirect()->route('profile');
        }

        $account_about_me->forceFill([
            'text' => $request->text,
        ])->save();

        return redirect()->route('profile');
    }

    public function update_account_username(Request $request)
    {
        if (!$request->new_username) {
            AccountUsernames::where('user_id', '=', Auth::user()->id)->where('platform', '=', $request->platform)->first()->delete();

            return redirect()->route('profile');
        }

        $account_username = AccountUsernames::where('user_id', '=', Auth::user()->id)->where('platform', '=', $request->platform)->first();

        if (!$account_username) {
            AccountUsernames::create([
                'user_id' => Auth::user()->id,
                'platform' => $request->platform,
                'username' => $request->new_username,
            ]);

            return redirect()->route('profile');
        }

        $account_username->forceFill([
            'username' => $request->new_username,
        ])->save();

        return redirect()->route('profile');
    }

    public function add_account_game(Request $request)
    {
        if ($request->name) {
            AccountGames::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
            ]);
        }

        return redirect()->route('profile');
    }

    public function remove_account_game(Request $request)
    {
        $account_game = AccountGames::findOrFail($request->id)->delete();

        return redirect()->route('profile');
    }

    public function search_users($searchTerm)
    {
        $users = User::where('username', 'like', '%' . $searchTerm . '%')->where('id', '!=', Auth::user()->id)->get();

        return response()->json($users->isEmpty() ? [] : $users);
    }

    public function display(Request $request, $username)
    {
        $user = User::where('username', '=', str_replace('@', '', $username))->first();

        if(!$user) {
            return redirect()->route('home');
        }

        $about_me = AccountAboutMes::where('user_id', '=', $user->id)->first();
        $gamer_usernames = AccountUsernames::where('user_id', '=', $user->id)->get();
        $games = AccountGames::where('user_id', '=', $user->id)->get();

        return view('display', [
            'path' => $request->path(),
            'username' => Auth::user()->username,
            'user' => $user,
            'about_me' => $about_me,
            'gamer_usernames' => $gamer_usernames,
            'games' => $games,
        ]);
    }
}
