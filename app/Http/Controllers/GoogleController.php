<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            // return dd($user);
            $findUser = User::where('id_google', $user->id)->first();
            if ($findUser) {
                if (
                    $user->name != $findUser->name ||
                    $user->avatar != $findUser->avatar
                ) {
                    $data['name'] = $user->name;
                    $data['avatar'] = $user->avatar;
                    $findUser->update($data);
                }
                Auth::login($findUser);
                $request->session()->regenerate();
                return redirect()->intended('dashboard')->with('login-success', 'Welcome to KontraKount!');
            } else {
                if (User::count() == 0) {
                    $admin = true;
                    $verified = date('Y-m-d H:i:s', time());
                } else {
                    $admin = false;
                    $verified = null;
                };
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'id_google' => $user->id,
                    'is_admin' => $admin,
                    'user_verified_at' => $verified,
                ]);
                Auth::login($newUser);
                return redirect()->intended('dashboard')->with('login-success', 'Welcome to KontraKount!');
            }
        } catch (Exception $e) {
            return dd($e);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/dashboard');
    }
}
