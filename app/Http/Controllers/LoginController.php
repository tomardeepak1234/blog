<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
 use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{

public function login(){
    return view('login');
}

public function loginCheck(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($request->only('email','password'))) {

        $request->session()->regenerate();

        $user = Auth::user();
       

        if ($user->role->name == 'User') {
            return redirect()->route('home');
        }
        elseif ($user->role->name == 'Author') {
            return redirect()->route('posts.index');
        }
        elseif($user->role->name == 'Admin') {
            return redirect()->route('admin');
        }
        else{
            return redirect()->route('login');
        }
    }

    return back()->withErrors(['email' => 'Invalid Email or Password']);
}

   public function logout(Request $request)
    {
        Auth::logout();                       
        $request->session()->invalidate();     
        $request->session()->regenerateToken();
        return redirect()->route('login');    
    }
}
