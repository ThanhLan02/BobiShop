<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\product_review;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function allproduct(){
        $product_news = Product::where('condition', '=', 'new')->paginate(5);
        $product_hots = Product::where('condition', '=', 'hot')->paginate(5);
        $products = Product::paginate(9);
        $count_all = Product::all()->count();
        $categories = category::all();
        $brands = brand::all();
        return view('user.allproduct',compact('product_news', 'product_hots','products','count_all','categories','brands'));
    }
    public function productbycatename($name){
        $cate = category::where('name',$name)->get();
        $products = Product::whereIn('category_id',$cate->pluck('id'))->paginate(9);
        $count_all = $products->count();
        $categories = category::all();
        $brands = brand::all();
        return view('user.productbycatename',compact('products','count_all','categories','brands'));
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
}
