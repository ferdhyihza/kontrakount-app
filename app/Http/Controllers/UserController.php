<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users', [
            'users' => $users
        ]);
    }

    public function verify(User $user)
    {
        $data['user_verified_at'] = date('Y-m-d H:i:s', time());
        User::where('id', $user->id)->update($data);
        return redirect('user');
    }
}
