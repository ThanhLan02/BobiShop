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
        return view('index',compact('product_news', 'product_hots'));
    }
    public function product_detail($id)
    {
        $product = Product::findOrFail($id);
        $product_other = Product::where('category_id', '=', $product->category_id)
                                ->where('quantity', '>', '0')
                                ->where('status', '=', 'active')
                                ->paginate(4);
        $reviews = product_review::where('product_id', $product->id)->paginate(3);
        $starCounts = product_review::selectRaw('rate, COUNT(*) as count')
        ->groupBy('rate')
        ->orderBy('rate', 'desc')
        ->get();
        $sumstar = product_review::sum('rate');
        $sumuser = product_review::where('product_id', $product->id)->count();
        $avgstar = $sumstar/$sumuser;
        //dd($avgstar);
        $product_image = image::where('product_id', '=', $id)->get();
        //dd($product_image);
        return view('user.product_detail', compact('product','product_image','product_image','starCounts','sumstar','sumuser','avgstar','reviews','product_other'));
    }
        
}
