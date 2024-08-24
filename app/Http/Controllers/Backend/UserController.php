<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\brand;
use App\Models\product;
use App\Models\category;
use App\Models\province;
use Illuminate\Http\Request;
use App\Models\product_review;
use App\Http\Requests\UsersRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function allproduct(){
        $product_news = Product::where('condition', '=', 'new')->paginate(5);
        $product_hots = Product::where('condition', '=', 'hot')->paginate(5);
        $product_discount = Product::where('discount', '>', '0')->paginate(3);
        $products = Product::paginate(9);
        $count_all = Product::all()->count();
        $categories = category::all();
        $brands = brand::all();
        return view('user.allproduct',compact('product_news', 'product_hots','products','count_all','categories','brands','product_discount'));
    }
    public function productbycatename($name){
        $cate = category::where('name',$name)->get();
        $products = Product::whereIn('category_id',$cate->pluck('id'))->paginate(9);
        $product_discount = Product::where('discount', '>', '0')->paginate(3);
        $count_all = $products->count();
        $categories = category::all();
        $brands = brand::all();
        return view('user.productbycatename',compact('products','count_all','categories','brands','name','product_discount'));
    }
    public function productbybrandname($name){
        $brand = brand::where('name',$name)->get();
        $products = Product::whereIn('brand_id',$brand->pluck('id'))->paginate(9);
        $product_discount = Product::where('discount', '>', '0')->paginate(3);
        $count_all = $products->count();
        $categories = category::all();
        $brands = brand::all();
        return view('user.productbybrandname',compact('products','count_all','categories','brands','name','product_discount'));
    }
    public function productbycate($id){
        $cate = category::find($id);
        $products = Product::where('category_id',$id)->paginate(9);
        $count_all = $products->count();
        $categories = category::all();
        $brands = brand::all();
        return view('user.productbycatename',compact('products','count_all','categories','brands'));
    }
    public function search(Request $request)
    {
        $query = $request->get('query');
        
        // Tìm kiếm trong cơ sở dữ liệu
        $results = product::where('name', 'LIKE', "%{$query}%")->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json($results);
    }
    public function submitreview(Request $request)
    {
        //dd($request);
        $review = new product_review();
        $review->product_id = $request->product_id;
        $review->user_id = Session::get('user');
        $review->rate = $request->rate;
        $review->review = $request->review;
        $review->save();

        return redirect()->back()->with('success', 'Cảm ơn bạn đã nhận xét');
    }
    public function profile()
    {
        $user = User::find(Session::get('user'));
        $provinces = province::all();
        return view('user.profile',compact('user','provinces'));
    }
    public function updateprofile(Request $request,$id)
    {
        //dd($request);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->description = $request->description;
        $user->address = $request->address;
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'renewpassword' => 'required|same:password',
        ]);
        if($request->newpassword !== $request->renewpassword)
        {
            return back()->withErrors(['renewpassword' => 'Mật khẩu nhập lại không đúng.']);
        }
        if($request->newpassword == $request->oldpassword)
        {
            return back()->withErrors(['newpassword' => 'Mật khẩu mới phải khác mật khẩu cũ.']);
        }
        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->oldpassword, Auth::user()->password)) {
            return back()->withErrors(['oldpassword' => 'Mật khẩu hiện tại không đúng.']);
        }

        // Cập nhật mật khẩu mới
        $user = User::findOrFail(Session::get('user'));
        $user->password = Hash::make($request->newpassword);
        $user->save();

        return back()->with('success', 'Mật khẩu đã được thay đổi thành công!');
    }
}
