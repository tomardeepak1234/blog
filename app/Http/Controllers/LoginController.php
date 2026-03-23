<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

public function login()
{
    if (Auth::check()) {

        $user = Auth::user();

        if ($user->role->name == 'Admin') {
            return redirect()->route('admin');

        } elseif ($user->role->name == 'Author') {
            return redirect()->route('posts.index');

        } elseif ($user->role->name == 'User') {
            return redirect()->route('home');
        }
    }

    return view('login');
}

    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);



        if (Auth::attempt($request->only('email', 'password'))) {

                $user = Auth::user();

            if ($user->role->name == 'User') {
                return redirect()->route('home');

            } elseif ($user->role->name == 'Author') {
                return redirect()->route('posts.index');

            } elseif ($user->role->name == 'Admin') {
                return redirect()->route('admin');

            } else {
                return redirect()->route('login');
            }
        }

        return back()->withErrors(['email' => 'Invalid Email or Password']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
