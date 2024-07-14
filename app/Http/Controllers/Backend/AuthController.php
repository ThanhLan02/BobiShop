<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function __construct()
    {
        
    }
    public function login(){
        if(Auth::id() > 0)
        {
            $find = User::find(Auth::user()->id);
            if($find->role == 2)
            {
                return redirect()->route('admin.index');
            }
            else
            {
                return redirect()->route('Home.index');
            }
        }
        return view('auth.login');
    }
    public function dologin(AuthRequest $request){  
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if(Auth::attempt($credentials)){
            $role = Auth::user()->role;
            $find = User::find(Auth::user()->id);
            Session::put('user',Auth::user()->id);
            Session::put('username',$find->name);
            //dd($find->quyen_id);
            $userId = Auth::user()->id;
            if($find->role != 2)
            {
                return redirect()->route('Home.index')->with('success','Đăng nhập thành công');
            }
            else
            {
                return redirect()->route('admin.index')->with('success','Đăng nhập thành công');
            }
            // return redirect()->route('Home.index')->with('success','Đăng nhập thành công');
        }
        return redirect()->route('auth.login')->with('error','Đăng nhập thất bại!! Email hoặc mật khẩu không chính xác');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
