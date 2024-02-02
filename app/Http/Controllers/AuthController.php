<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function index()
    {
        return view('auth/index');
    }


    function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required|min:0',
        // ]);

        // $auth = Auth::where('email', $request->email)->first();

        // if (empty($auth)) {
        //     $request->session()->put('error', 'email không đúng');
        //     return redirect()->back();
        // }

        // // compare password 
        // if (Hash::check($request->password, $auth->password)) {
        //     $request->session()->put('email', $auth->email);
        //     FacadesAuth::login($auth);
        //     return redirect('/food');
        // } else {
        //     $request->session()->put('error', 'password không đúng');
        //     return redirect()->back();
        // }


        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/food');
        } else {
            return redirect()->route('auth')->with('error_login', 'Email hoặc mật khẩu không đúng');
        }
    }

    function register(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'password' => 'required|min:0',
            'rePassword' => 'required|min:0',
        ]);

        if ($request->password != $request->rePassword) {
            return redirect()->route('auth')->with('error_login', 'Mật khẩu không khớp');
        }

        // hash password
        $hash = Hash::make($request->password);

        // create a new user 
        $data = Arr::except($request->all(), ['password']);
        User::create([...$data, 'password' => $hash]);

        return redirect()->route('auth')->with('success', 'Đăng ký thành công');
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('auth')->with('success', 'Đăng xuất thành công');
    }
}
