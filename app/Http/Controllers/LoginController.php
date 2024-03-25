<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function auth(Request $req){
        $credentials = $req->validate(
            ['email'=>'required', 'password'=>'required'],
            ['email.required'=>'Harap masukan email!', 'password.required'=>'Harap masukan password!']
        );

        if(Auth::attempt($credentials)){
            if(Auth::user()->level=='admin'){
                return redirect()->intended('/');
            }
            return redirect()->intended('/infoker');
        }
        return back()->withErrors('Username atau Password salah!')->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
