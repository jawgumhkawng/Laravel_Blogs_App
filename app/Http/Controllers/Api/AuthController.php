<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public static function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:25',

        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return $user;
    }
}
