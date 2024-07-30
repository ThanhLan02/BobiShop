<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\image;

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
        $product_image = image::where('product_id', '=', $id)->get();
        //dd($product_image);
        return view('user.product_detail', compact('product','product_image'));
    }
        
}
