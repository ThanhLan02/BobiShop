<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\province;
use App\Models\password_reset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UsersRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function __construct() {}
    public function login()
    {
        if (Auth::id() > 0) {
            $find = User::find(Auth::user()->id);
            if ($find->role == 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('Home.index');
            }
        }
        return view('auth.login');
    }
    public function dologin(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if (Auth::attempt($credentials)) {
            $find = User::find(Auth::user()->id);
            if ($find->status == 'inactive') {
                Auth::logout();
                return redirect()->route('auth.login')->with('error', 'Tài khoản của bạn đã bị khóa');
            } else {
                Session::put('user', $find->id);
                Session::put('username', $find->name);
                //dd($find->quyen_id);
                $userId = Auth::user()->id;
                if ($find->role != 'admin') {
                    return redirect()->route('Home.index')->with('success', 'Đăng nhập thành công');
                } else {
                    return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công');
                }
            }

            // return redirect()->route('Home.index')->with('success','Đăng nhập thành công');
        }
        return redirect()->route('auth.login')->with('error', 'Đăng nhập thất bại!! Email hoặc mật khẩu không chính xác');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login')->with('success', 'Đăng xuất thành công');
    }
    public function register()
    {
        if (Auth::id() > 0) {
            return redirect()->route('Home.index');
        }
        $provinces = province::all();
        return view('auth.register', compact('provinces', $provinces));
    }
    public function registerSubmit(RegisterRequest $request)
    {
        $data = $request->all();
        //dd($data);
        $data['password'] = Hash::make($request->password);
        $check = User::create($data);

        if ($check) {
            session()->flash('success', 'Đăng ký thành công');
            return redirect()->route('auth.login')->with('success', 'Đăng ký thành công');
        } else {
            session()->flash('error', 'Đăng ký thất bại!!!!');
            return back()->with('error', 'Đăng ký thất bại!');
        }
    }
    public function requestForm()
    {
        return view('auth.forgot-password');
    }

    // Xử lý gửi email chứa link reset mật khẩu
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            session()->flash('error', 'Email không tồn tại!!!');
            return back();
        }

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.emails.password-reset', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Đổi mật khẩu');
        });
        Session::put('email_reset_password', $request->email);
        return back()->with('success', 'Link reset mật khẩu đã được gửi vào email.');
    }

    // Hiển thị form đổi mật khẩu khi người dùng nhấp vào link
    public function showResetForm($token)
    {
        //dd(Session::get('email_reset_password'));
        $token = password_reset::where('email', Session::get('email_reset_password'))->first();
        $email_reset = Session::get('email_reset_password');
        return view('auth.reset-password', compact('token', 'email_reset'));
    }

    // Xử lý cập nhật mật khẩu mới
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'token' => 'required'
        ]);
        //dd($request);
        //dd($request->token);
        $reset = DB::table('password_resets')->where([
            ['email', $request->email],
            ['token', $request->token]
        ])->first();
        if (!$reset) {
            session()->flash('error', 'Token không hợp lệ.!!');
            return back();
        }

        if ($request->password != $request->password_confirmation) {
            return back()->withErrors(['password_confirmation' => '2 mật khẩu phải giống nhau']);
        }
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where(['email' => $request->email])->delete();
        session()->forget('email_reset_password');
        return redirect()->route('auth.login')->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }
}
