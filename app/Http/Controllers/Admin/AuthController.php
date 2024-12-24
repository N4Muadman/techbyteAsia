<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(){
        return view('admin.login');
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($data)){
            return redirect()->route('admin');
        }

        return redirect()->back()->withErrors([
            'loginError' => 'Email or password is incorrect.',
        ]);
    }

    public function logout(){
        if(Auth::check()){
            Auth::logout();
        }

        return redirect()->route('login.form');
    }
}
