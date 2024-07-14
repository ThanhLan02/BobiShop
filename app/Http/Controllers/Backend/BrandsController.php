<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use App\Models\brand;
use Illuminate\Support\Facades;

class BrandsController extends Controller
{
    protected $model;
    public function __construct(brand $model)
    {
        $this->model=$model;
    }
    public function index(){

        $brands = brand::paginate(5);
        return view('admin.brand.index',compact('brands'));
    }
    public function brandcreate()
    {
        return view('admin.brand.create');
    }
    public function brandstore(BrandRequest $request)
    {
        $data=$request->all();
         //dd($data);
        $status=brand::create($data);
        // dd($status);
        if($status){
            session()->flash('success','Thêm brand thành công');
        }
        else{
            session()->flash('error','Lỗi, Hãy Xem lại');
            return redirect()->back();
        }
        return redirect()->route('admin.brand');
    }
    public function branddelete($id)
    {
        $brand=brand::find($id);
        if($brand){
            $status=$brand->delete();
            if($status){
                session()->flash('success','Xóa brand thành công');
            }
            else{
                session()->flash('error','Lỗi, Hãy Xem lại');
            }
            return redirect()->route('admin.brand');
        }
        else{
            session()->flash('error','Brand not found');
            return redirect()->back();
        }
    }
    public function brandupdate($id)
    {
        $brand=brand::findOrFail($id);
        //$hang = hang::find($MaHang);
        if(!$brand){
            session()->flash('error','Brand not found');
        }
        return view('admin.brand.update')->with('brand',$brand);
    }
    public function branddoupdate(BrandRequest $request, $id)
    {
        $brand=Brand::find($id);
        $data=$request->all();
       
        $status=$brand->fill($data)->save();
        if($status){
            session()->flash('success','Cập nhật thành công');
        }
        else{
            session()->flash('error','Cập nhật không thành công');
        }
        return redirect()->route('admin.brand');
    }
}
