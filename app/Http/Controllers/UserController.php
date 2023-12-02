<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile($id)
    { 
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('/profile', compact('user'));
    }

    public function upload(User $user)
    {
       
        $id = Auth::user()->id;
         $user = User::find($id);

          $validator = validator(request()->all(), [
               
                'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
                
                ]);

        if($validator->fails()) {

            return back()->withErrors($validator);

          }

       

        $imageName = date('YmdHis'). "." .request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        $user->image = $imageName;

        $user->save();

        return back()->with('msg','profile photo upload success');
    }
}