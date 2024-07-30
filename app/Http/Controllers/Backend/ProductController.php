<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\brand;
use App\Models\category;
use App\Models\image;
use App\Models\product;
use App\Models\supplier;
use App\Models\variant;
use App\Models\variant_value;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $model;
    public function __construct(product $model)
    {
        $this->model=$model;
    }
    public function index(){

        $products = product::paginate(3);
        $brands = brand::all();
        return view('admin.product.index',compact('products','brands'));
    }
    public function productcreate()
    {
        $categories = DB::table('category')->get();
        $brands = brand::all();
        return view('admin.product.create',compact('categories','brands'));
    }
    public function productstore(ProductRequest $request)
    {
        // $this->validate($request,[
        //     'name' =>'required',
        //     'description' =>'required|nullable',
        //     'quantity' =>'required|numeric',
        //     'category_id' =>'required|exists:category,id',
        //     'brand_id' =>'required|exists:brands,id',
        //     'image' => 'string|required',
        //     'condition' =>'required',
        // ]);
        $data=$request->all();
        // dd($data);
        $base_url = env('APP_URL');
        $data['image'] = str_replace($base_url, '', $request->image);
        if($request->discount!==null)
        {
            $data['old_price'] = $request->old_price;
            $data['new_price'] = $request->old_price - ($request->old_price * $request->discount / 100);

        }else
        {
            $data['old_price'] = $request->old_price;
            $data['new_price'] = 0;
        }
        $data_2['url_image'] = $data['image'];
        
        
        
        
        $status=product::create($data);
        if($status){
            session()->flash('success','Thêm product thành công');
            $maxId = product::max('id');
            $data_2['product_id'] = $maxId;
            //dd($data_2);
            $status=image::create($data_2);
        }
        else{
            session()->flash('error','Lỗi, Hãy Xem lại');
            return redirect()->back();
        }
        return redirect()->route('admin.product');
    }
    public function productdelete($id)
    {
        $product=product::find($id);
        $product_images = image::where('product_id',$product->id)->get();
        //dd($product_images);
        if($product){
            $status=$product->delete();
            foreach ($product_images as $image) {
                $image->delete();
            }
            if($status){
                session()->flash('success','Xóa product thành công');
            }
            else{
                session()->flash('error','Lỗi, Hãy Xem lại');
            }
            return redirect()->route('admin.product');
        }
        else{
            session()->flash('error','product not found');
            return redirect()->back();
        }
    }
    public function productupdate($id)
    {
        $categories = DB::table('category')->get();
        $brands = brand::all();
        $product=product::findOrFail($id);
        if(!$product){
            session()->flash('error','product not found');
        }
        $base_url = env('APP_URL');
        return view('admin.product.update')->with('product',$product)->with('categories',$categories)->with('brands',$brands)->with('base_url',$base_url);
    }
    public function productdoupdate(ProductRequest $request, $id)
    {
        $product=product::find($id);
        $data=$request->all();
        $base_url = env('APP_URL');
        $data['image'] = str_replace($base_url, '', $request->image);
        if($request->discount!==null)
        {
            $data['old_price'] = $request->old_price;
            $data['new_price'] = $request->old_price - ($request->old_price * $request->discount / 100);

        }else
        {
            $data['old_price'] = $request->old_price;
            $data['new_price'] = 0;
        }
        $status=$product->fill($data)->save();
        if($status){
            session()->flash('success','Cập nhật thành công');
        }
        else{
            session()->flash('error','Cập nhật không thành công');
        }
        return redirect()->route('admin.product');
    }
    public function updateProductStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->status = $request->input('status');
        $product->save();

        // Redirect back or to another page
        return response()->json(['message' => 'Cập nhật thành công'], 200);
    }
}
