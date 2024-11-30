<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\order_details;
use Illuminate\Http\Request;
use App\Models\orders;

class OrdersController extends Controller
{
    protected $model;
    public function __construct(orders $model)
    {
        $this->model = $model;
    }
    public function index()
    {

        //$orders = orders::paginate(5);
        $orders = orders::where('payment_status', 'pending')
            ->orderByRaw("CASE WHEN status = 'new' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    public function ordersdoupdate($id)
    {
        $order = orders::find($id);
        $order->status = 'process';
        $sta = $order->save();
        if ($sta) {
            session()->flash('success', 'Xác nhận đơn hàng thành công');
        } else {
            session()->flash('error', 'Xác nhận đơn hàng không thành công');
        }
        return redirect()->back();
    }
    public function ordercomfirm($id)
    {
        $order = orders::find($id);
        $order->status = 'delivered';
        $order->payment_status = 'success';
        $sta = $order->save();
        if ($sta) {
            session()->flash('success', 'Cảm ơn bạn đã mua hàng!!');
        } else {
            session()->flash('error', 'Lỗi !! Không thể xác nhận');
        }
        return redirect()->back();
    }
    public function orderscancel($id)
    {
        $order = orders::find($id);
        if ($order) {
            //dd($order);
            $order->status = 'cancel';
            $sta = $order->save();
            if ($sta) {
                session()->flash('success', 'Hủy đơn hàng thành công');
            } else {
                session()->flash('error', 'Lỗi, Hãy Xem lại');
            }
            return redirect()->back();
        } else {
            session()->flash('error', 'Brand not found');
            return redirect()->back();
        }
    }
    public function getOrderDetails($id)
    {
        $order = order_details::with('products')->where('order_id', $id)->get();
        //dd($order);
        return response()->json($order);
    }
}
