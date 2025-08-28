<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function loginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('admin')
            ->attempt(['email' => $request->email , 'password' => $request->password])
        ){
            return redirect()->route('admin.dashboard.show');
        }
        return redirect()
            ->back()
            ->withInput($request->only('email'))
            ->with('error', 'ایمیل یا رمز عبور اشتباه است.');
    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth.login-form');
    }
}
