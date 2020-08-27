<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
class AuthController extends Controller

{
    public function getViewLogin()
    {
        return view('login');
    }

    //login
    public function login(Request $request)
    {
        $mess = 'tài khoản hoặc mật khẩu không đúng';
        $username = $request->username;
        $pass = $request->password;

        // $user = App\User::find(2);
        // if(Auth::login($user)){
        //     return view('successfully');
        // }else {
        //     return view('login',['er'=>$mess]);
        // }

        if(Auth::attempt(['name' => $username, 'password' => $pass])){
            return view('successfully');
        }else{
            return view('login',['er'=>$mess]);
        }
    }

    //logout
    public function logout()
    {
        Auth::logout();
        return view('login');
    }
}
