<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;

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
}
