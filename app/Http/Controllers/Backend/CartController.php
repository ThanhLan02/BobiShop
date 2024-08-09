<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\cart;
use App\Models\User;
use App\Models\orders;
use App\Models\order_details;
use App\Models\province;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\MomoPaymentService;

class CartController extends Controller
{
    protected $product = null;
    protected $momoPaymentService;
    public function __construct(Product $product,MomoPaymentService $momoPaymentService)
    {
        $this->product = $product;
        $this->momoPaymentService = $momoPaymentService;
    }
    public function index()
    {
        $cart = cart::where('user_id', Session::get('user'))->get();
        $tongtien = cart::where('user_id', Session::get('user'))->sum('amount');

        return view('user.cart', compact('cart', 'tongtien'));
    }
    public function checkout()
    {
        $provinces = province::all();
        $cart = cart::where('user_id', Session::get('user'))->get();
        $tongtien = cart::where('user_id', Session::get('user'))->sum('amount');
        $user = User::where('id', Session::get('user'))->first();
        $itemCount = $cart->count();
        if($itemCount > 0)
        {
            return view('user.checkout', compact('cart', 'tongtien', 'user', 'provinces'));
        }
        else
        {
            session()->flash('success','Bạn chưa chọn sản phẩm nào cả');
            return redirect()->route('Home.index');
        }
        
    }
    public function AddToCart($id)
    {
        $product = $this->product->findOrFail($id);
        $cart = cart::where('product_id', $id)->where('user_id', Session::get('user'))->get();
        //dd($product->quantity);
        if (count($cart) > 0) {
            foreach ($cart as $key) {
                $key->quantity = $key->quantity + 1;
                if($product->quantity < $key->quantity)
                {
                    session()->flash('error','Sản phẩm không đủ hàng');
                    return redirect()->back();
                }
                $key->amount = $key->quantity * $key->price;
                $key->save();
            }
        } else {
            if ($product->discount != null || $product->discount == 0) {
                $addcart = new cart();
                $addcart->user_id = Session::get('user');
                $addcart->product_id = $product->id;
                $addcart->quantity = 1;
                $addcart->price = $product->old_price;
                $addcart->amount = $product->old_price;
                $addcart->save();
            } else {
                $addcart = new cart();
                $addcart->user_id = Session::get('user');
                $addcart->product_id = $product->id;
                $addcart->quantity = 1;
                $addcart->price = $product->new_price;
                $addcart->amount = $product->new_price;
                $addcart->save();
            }
        }
        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
    }
    public function AddManyCart(Request $request,$id)
    {
        $product = $this->product->findOrFail($id);
        $cart = cart::where('product_id', $id)->where('user_id', Session::get('user'))->get();
        //dd($cart);
        // if ($product->quantity < $request->input('quantity')) 
        // {
        //     session()->flash('success', 'Sản phẩm không đủ hàng');
        //     return redirect()->back();
        // }
        if (count($cart) > 0) {
            foreach ($cart as $key) {
                $key->quantity = $key->quantity + $request->input('quantity');
                if ($product->quantity < $key->quantity) {
                    session()->flash('error', 'Sản phẩm không đủ hàng');
                    return redirect()->back();
                }
                $key->amount = $key->quantity * $key->price;
                $key->save();
            }
        } else if ($product->quantity < $request->input('quantity')) {
            session()->flash('error', 'Sản phẩm không đủ hàng');
            return redirect()->back();
        } else {
            if ($product->discount == null || $product->discount == 0) {
                $addcart = new cart();
                $addcart->user_id = Session::get('user');
                $addcart->product_id = $product->id;
                $addcart->quantity = $request->input('quantity');
                $addcart->price = $product->old_price * $request->input('quantity');
                $addcart->amount = $product->old_price * $request->input('quantity');
                $addcart->save();
            } else {
                $addcart = new cart();
                $addcart->user_id = Session::get('user');
                $addcart->product_id = $product->id;
                $addcart->quantity = $request->input('quantity');
                $addcart->price = $product->new_price * $request->input('quantity');
                $addcart->amount = $product->new_price * $request->input('quantity');
                $addcart->save();
            }
        }
        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
    }
    public function deletesinglecart($id)
    {
        $cart = cart::find($id);
        if ($cart) {
            $cart->delete();
            session()->flash('success', 'Xóa thành công');
        } else {
            session()->flash('error', 'Xóa không thành công');
        }
        return redirect()->back();
    }
    public function deleteallcart()
    {
        $cart = cart::where('user_id', Session::get('user'))->get();
        if ($cart->count() > 0) {
            foreach ($cart as $item) {
                $item->delete();
            }
            session()->flash('success', 'Xóa thành công');
        } else {
            session()->flash('success', 'Khong co gi de xoa');
        }
        return redirect()->back();
    }
    public function updatequantitycart(Request $request, $id)
    {
        $cart = cart::find($id);
        $product = product::where('id',$cart->product_id)->get();
        foreach ($product as $item) {
            if ($item->quantity < $cart->quantity) {
                session()->flash('success', 'Sản phẩm không đủ');
                return redirect()->back();
            }
        }
        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->amount = $request->quantity * $cart->price;
            $cart->save();
            session()->flash('success', 'Cập nhật thành công');
        } else {
            session()->flash('success', 'Cập nhật không thành công');
        }
        return redirect()->back();
    }
    public function payment_cash(Request $request)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $order = new orders();
        $order->user_id = Session::get('user');
        $order->order_date = $currentDate;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->messages = $request->messages;
        $order->amount = cart::where('user_id', Session::get('user'))->sum('amount');
        $order->payment_method = 'cash';
        $order->payment_status = 'pending';
        $order->status = 'new';
        //dd($order);
        $order->save();
        $cart = cart::where('user_id', Session::get('user'))->get();
        foreach ($cart as $item) {
            $orderDetail = new order_details();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item->product_id;
            $orderDetail->quantity = $item->quantity;
            $orderDetail->price = $item->price;
            $orderDetail->amount = $item->amount;
            $orderDetail->save();
        }
        cart::where('user_id', Session::get('user'))->delete();
        session()->flash('success', 'Đặt hàng thành công');
        return redirect()->route('user.thanksfororder');
    }
    public function tracking_order($id)
    {
        $order_details = order_details::where('order_id', $id)->get();
        return view('user.tracking_order', compact('order_details', 'id'));
    }
    public function order_list()
    {
        $orders = orders::where('user_id', Session::get('user'))->get();
        return view('user.order_list', compact('orders'));
    }
    public function thanksfororder()
    {
        return view('user.thanksfororder');
    }
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function paymentmomo(Request $request)
    {
        //dd($request);
        $tongtien = cart::where('user_id', Session::get('user'))->sum('amount');
        $currentDate = Carbon::now()->format('Y-m-d');
        $order = new orders();
        $order->user_id = Session::get('user');
        $order->order_date = $currentDate;
        $order->name = $request->name2;
        $order->email = $request->email2;
        $order->phone = $request->phone2;
        $order->address = $request->address2;
        $order->messages = $request->messages2;
        $order->amount = cart::where('user_id', Session::get('user'))->sum('amount');
        $order->payment_method = 'online';
        $order->payment_status = 'pending';
        $order->status = 'new';
        //dd($order);
        $order->save();
        $cart = cart::where('user_id', Session::get('user'))->get();
        foreach ($cart as $item) {
            $orderDetail = new order_details();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item->product_id;
            $orderDetail->quantity = $item->quantity;
            $orderDetail->price = $item->price;
            $orderDetail->amount = $item->amount;
            $orderDetail->save();
        }
        cart::where('user_id', Session::get('user'))->delete();
        $maxId = orders::max('id');

        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $tongtien ."";
        //$orderId = $maxId;
        // $amount = "10000";
         $orderId = time() ."";
        //dd($orderId);
        $base_url = env('APP_URL');
        //dd($base_url);
        $returnUrl = $base_url . '/payment/return';
        $notifyurl = $base_url . '/payment/notify';
        // Lưu ý: link notifyUrl không phải là dạng localhost
        $bankCode = "SML";

        $requestId = time() ."";
        $requestType = "payWithMoMoATM";
        $extraData = "";
        //before sign HMAC SHA256 signature
        $rawHashArr =  array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'bankCode' => $bankCode,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType
        );
        // echo $serectkey;die;
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&bankCode=" . $bankCode . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        //dd($signature);
        $data =  array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'bankCode' => $bankCode,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        // In ra thông tin để kiểm tra
        error_log("Request Data: " . json_encode($data));
        error_log("Raw Hash: " . $rawHash);
        error_log("Signature: " . $signature);

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        //dd($result);
        error_log(print_r($jsonResult, true));
        //dd($jsonResult['payUrl']);
        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']);
        } else {
            $errorMessage = isset($jsonResult['message']) ? $jsonResult['message'] : 'Có lỗi xảy ra khi xử lý thanh toán.';
            //dd($errorMessage);
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    // public function pay(Request $request)
    // {
    //     $orderInfo = "Thanh toán đơn hàng";
    //     $amount = $request->input('amount');
    //     $orderId = time() . "";
    //     $returnUrl = route('payment.return');
    //     $notifyUrl = route('payment.notify');

    //     $result = $this->momoPaymentService->createPayment($orderInfo, $amount, $orderId, $returnUrl, $notifyUrl);
    //     dd($result);
    //     return redirect($result['payUrl']);
    // }

    public function return(Request $request)
    {
        //dd($request);
        // Lấy các tham số từ query string
        $resultCode = $request->query('resultCode');
        $orderId =  orders::max('id');
        $message = $request->query('message');

        if ($message == 'Success') {
            // Thanh toán thành công
            orders::where('id', $orderId)->update(['payment_status' => 'success']);
            return view('user.thanksfororder');
        } else {
            // Thanh toán thất bại
            $order = orders::find($orderId);
            $order->delete();
            $order_detail = order_details::where('order_id', $orderId)->get();
            foreach ($order_detail as $item) {
                $item->delete();
            }
            session()->flash('error','Thanh toán thất bại');
            return redirect()->route('user.checkout');
        }
        }

    public function notify(Request $request)
    {
        dd($request);
        $data = $request->all();
        $signature = $data['signature'];
        $orderId =  orders::max('id');
        $resultCode = $data['errorCode'];

        // Tạo lại raw data để kiểm tra chữ ký
        $rawHash = "partnerCode=" . $data['partnerCode'] .
        "&accessKey=" . $data['accessKey'] .
        "&requestId=" . $data['requestId'] .
        "&amount=" . $data['amount'] .
        "&orderId=" . $data['orderId'] .
        "&orderInfo=" . $data['orderInfo'] .
        "&orderType=" . $data['orderType'] .
        "&transId=" . $data['transId'] .
        "&message=" . $data['message'] .
        "&localMessage=" . $data['localMessage'] .
        "&responseTime=" . $data['responseTime'] .
        "&errorCode=" . $data['errorCode'] .
        "&payType=" . $data['payType'] .
        "&extraData=" . $data['extraData'];

        $secretKey = env('MOMO_SECRET_KEY');
        $calculatedSignature = hash_hmac("sha256", $rawHash, $secretKey);

        if ($signature == $calculatedSignature) {
            if ($resultCode == 0) {
                orders::where('id', $orderId)->update(['payment_status' => 'success']);
                return view('user.thanksfororder');
            } else {
                    // Thanh toán thất bại
                $order = orders::find($orderId);
                $order->delete();
                $order_detail = order_details::where('order_id', $orderId)->get();
                foreach ($order_detail as $item) {
                    $item->delete();
                }
                session()->flash('error','Thanh toán thất bại');
                return redirect()->route('user.checkout');
            }
        } else {
                session()->flash('error','Thanh toán momo lỗi');
                return redirect()->route('user.checkout');
        }
    }
}
