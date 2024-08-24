<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\image;
use App\Models\product_review;

class HomeController extends Controller
{
    public function __construct()
    {
        
    }
    public function index(){
        $product_news = Product::where('condition', '=', 'new')->paginate(5);
        $product_hots = Product::where('condition', '=', 'hot')->paginate(5);
        $product_new_list_1 = Product::where('condition', '=', 'new')->skip(0)->take(3)->get();
        $product_new_list_2 = Product::where('condition', '=', 'new')->skip(3)->take(3)->get();
        $product_hot_list_1 = Product::where('condition', '=', 'hot')->skip(0)->take(3)->get();
        $product_hot_list_2 = Product::where('condition', '=', 'hot')->skip(3)->take(3)->get();
        return view('index',compact('product_news', 'product_hots','product_new_list_1','product_hot_list_2','product_new_list_2','product_hot_list_1'));
    }
    public function product_detail($id)
    {
        $product = Product::findOrFail($id);
        $product_other = Product::where('category_id', '=', $product->category_id)
                                ->where('quantity', '>', '0')
                                ->where('status', '=', 'active')
                                ->where('id', '!=', $id)
                                ->take(4)
                                ->get();
        //dd($product_other);
        $reviews = product_review::where('product_id', $product->id)->paginate(3);
        $starCounts = product_review::selectRaw('rate, COUNT(*) as count')
        ->where('product_id', $product->id)
        ->groupBy('rate')
        ->orderBy('rate', 'desc')
        ->get();
        $sumstar = product_review::where('product_id', $product->id)->sum('rate');
        $sumuser = product_review::where('product_id', $product->id)->count();
        if($sumstar != 0 && $sumuser != 0)
        {
            $avgstar = $sumstar/$sumuser;
            
        }
        else
        {
            $avgstar = 0;
        }
        
        //dd($sumuser);
        $product_image = image::where('product_id', '=', $id)->get();
        //dd($product_image);
        return view('user.product_detail', compact('product','product_image','product_image','starCounts','sumstar','sumuser','avgstar','reviews','product_other'));
    }
        
}
