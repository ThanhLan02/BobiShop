<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $model;
    public function __construct(category $model)
    {
        $this->model=$model;
    }
    public function index(){

        $categorys = category::paginate(5);
        return view('admin.category.index',compact('categorys'));
    }
    public function categorycreate()
    {
        return view('admin.category.create');
    }
    public function categorystore(CategoryRequest $request)
    {
        $data=$request->all();
         //dd($data);
        $status=category::create($data);
        // dd($status);
        if($status){
            session()->flash('success','Thêm category thành công');
        }
        else{
            session()->flash('error','Lỗi, Hãy Xem lại');
            return redirect()->back();
        }
        return redirect()->route('admin.category');
    }
    public function categorydelete($id)
    {
        $category=category::find($id);
        if($category){
            $status=$category->delete();
            if($status){
                session()->flash('success','Xóa category thành công');
            }
            else{
                session()->flash('error','Lỗi, Hãy Xem lại');
            }
            return redirect()->route('admin.category');
        }
        else{
            session()->flash('error','category not found');
            return redirect()->back();
        }
    }
    public function categoryupdate($id)
    {
        $category=category::findOrFail($id);
        //$hang = hang::find($MaHang);
        if(!$category){
            session()->flash('error','category not found');
        }
        return view('admin.category.update')->with('category',$category);
    }
    public function categorydoupdate(CategoryRequest $request, $id)
    {
        $category=category::find($id);
        $data=$request->all();
       
        $status=$category->fill($data)->save();
        if($status){
            session()->flash('success','Cập nhật thành công');
        }
        else{
            session()->flash('error','Cập nhật không thành công');
        }
        return redirect()->route('admin.category');
    }
}
