<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::id() == null)
        {
            return redirect()->route('auth.login')->with('error','Bạn phải đăng nhập để sử dụng chức năng');
        }
        else
        {
            $find = User::find(Auth::user()->id);
        }
        return $next($request); 
        // if($request->user()->role=='2'){
        //     return $next($request);
        // }
        // else{
        //     session()->flash('error','You do not have any permission to access this page');
        //     return redirect()->route($request->user()->role);
        // }
    }
}
