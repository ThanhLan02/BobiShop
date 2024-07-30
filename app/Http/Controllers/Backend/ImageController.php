<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use App\Models\product;
use App\Models\image;

class ImageController extends Controller
{
    protected $model;
    public function __construct(image $model)
    {
        $this->model=$model;
    }
    public function index(){

        $images = image::paginate(5);
        return view('admin.image.index',compact('images'));
    }
    public function imagecreate()
    {
        $products = product::all();
        return view('admin.image.create',compact('products'));
    }
    public function imagestore(ImageRequest $request)
    {
        $data=$request->all();
         //dd($data);
        $base_url = env('APP_URL');
        $data['url_image'] = str_replace($base_url, '', $request->url_image);
        $status=image::create($data);
        // dd($status);
        if($status){
            session()->flash('success','Thêm image thành công');
        }
        else{
            session()->flash('error','Lỗi, Hãy Xem lại');
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function imagedelete($id)
    {
        $image=image::find($id);
        if($image){
            $status=$image->delete();
            if($status){
                session()->flash('success','Xóa image thành công');
            }
            else{
                session()->flash('error','Lỗi, Hãy Xem lại');
            }
            return redirect()->route('admin.image');
        }
        else{
            session()->flash('error','image not found');
            return redirect()->back();
        }
    }
    public function imageupdate($id)
    {
        $image=image::findOrFail($id);
        $products = product::all();
        $base_url = env('APP_URL');
        //$hang = hang::find($MaHang);
        if(!$image){
            session()->flash('error','image not found');
        }
        return view('admin.image.update')->with('image',$image)->with('products',$products)->with('base_url',$base_url);
    }
    public function imagedoupdate(ImageRequest $request, $id)
    {
        $image=image::find($id);
        $data=$request->all();
        $base_url = env('APP_URL');
        $data['url_image'] = str_replace($base_url, '', $request->url_image);
        $status=$image->fill($data)->save();
        if($status){
            session()->flash('success','Cập nhật thành công');
        }
        else{
            session()->flash('error','Cập nhật không thành công');
        }
        return redirect()->route('admin.image');
    }
}
