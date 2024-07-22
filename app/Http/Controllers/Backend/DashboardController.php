<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        
    }
    public function index()
    {
        if(Session::get('user') > 0)
        {
            $find = User::find(Session::get('user'));
            if($find->role == 'admin')
            {
                // $danhthucn = hoadon::where('NguoiNhan',Session::get('user'))->sum('TongTien');
                // $danhthucnformat = number_format($danhthucn,0);
                // $doanhthu = hoadon::sum('TongTien');
                // $doanhthucnformat = number_format($doanhthu,0);
                // $sodon = hoadon::count();
                // $sodonphantram = hoadon::count() / 10000;
                // $dg1 = danhgia::count();
                // $dg2 = danhgia_taixe::count();
                // $sodanhgia = $dg1 + $dg2;
                return view('admin.dashboard')->with('success','Chào mừng trở lại');
            }
            else
            {
                return redirect()->route('Home.index')->with('error','Bạn không có quyền truy cập vào trang này!!');
            }
        }
        
    }
}
