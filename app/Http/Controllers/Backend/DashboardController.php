<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\orders;
use App\Models\product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct() {}
    public function index()
    {
        $order_new = orders::where('status', 'new')->count();
        $order_delivered = orders::where('status', 'delivered')->count();
        $users = User::where('role', 'user')->count();
        $totalrevenue = orders::where('status', 'delivered')->sum('amount');
        $totalproduct = product::where('quantity', '>', '0')->count();
        $revenue = DB::table('orders')
            ->select(DB::raw('YEAR(order_date) as year'), DB::raw('MONTH(order_date) as month'), DB::raw('SUM(amount) as total_revenue'))
            ->where('payment_status', 'success')
            ->groupBy(DB::raw('YEAR(order_date)'), DB::raw('MONTH(order_date)'))
            ->orderBy(DB::raw('YEAR(order_date)'), 'asc')
            ->orderBy(DB::raw('MONTH(order_date)'), 'asc')
            ->get();

        // if ($revenue->isEmpty()) {
        //     dd("Không có");
        // }
        //dd($revenue);
        if (Session::get('user') > 0) {
            $find = User::find(Session::get('user'));
            if ($find->role == 'admin') {
                return view('admin.dashboard', compact('order_new', 'users', 'totalrevenue', 'totalproduct', 'order_delivered', 'revenue'))->with('success', 'Chào mừng trở lại');
            } else {
                return redirect()->route('Home.index')->with('error', 'Bạn không có quyền truy cập vào trang này!!');
            }
        }
    }
}
