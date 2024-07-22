<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\brand;
use App\Models\category;
use App\Models\product;
use App\Models\supplier;
use App\Models\variant;
use App\Models\variant_value;
use App\Models\User;
use App\Models\role;
use App\Models\province;
use App\Models\district;
use App\Models\ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    protected $model;
    public function __construct(User $model)
    {
        $this->model=$model;
    }
    public function index(){

        $users = User::paginate(5);
        
        return view('admin.users.index',compact('users'));
    }
    public function userscreate()
    {
        $provinces = province::all();
        return view('admin.users.create',compact('provinces'));
    }
    public function usersstore(UsersRequest $request)
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
        $data['password']=Hash::make($request->password);
        //dd($data);
        $status=User::create($data);
        if($status){
            session()->flash('success','Thêm User thành công');
        }
        else{
            session()->flash('error','Lỗi, Hãy Xem lại');
            return redirect()->back();
        }
        return redirect()->route('admin.users');
    }
    public function usersdelete($id)
    {
        $user=User::find($id);
        if($user){
            $status=$user->delete();
            if($status){
                session()->flash('success','Xóa user thành công');
            }
            else{
                session()->flash('error','Lỗi, Hãy Xem lại');
            }
            return redirect()->route('admin.users');
        }
        else{
            session()->flash('error','user not found');
            return redirect()->back();
        }
    }
    public function usersupdate($id)
    {
        $provinces = province::all();
        $user=User::findOrFail($id);
        if(!$user){
            session()->flash('error','user not found');
        }
        $base_url = env('APP_URL');
        return view('admin.users.update')->with('user',$user)->with('base_url',$base_url)->with('provinces',$provinces);
    }
    public function usersdoupdate(UpdateUserRequest $request, $id)
    {
        $user=User::find($id);
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
        $status=$user->fill($data)->save();
        if($status){
            session()->flash('success','Cập nhật thành công');
        }
        else{
            session()->flash('error','Cập nhật không thành công');
        }
        return redirect()->route('admin.users');
    }
    public function updateUsersStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->input('status');
        $user->save();
        return response()->json(['message' => 'Cập nhật thành công'], 200);
    }
    public function provinceapi()
    {
        $json_data = file_get_contents('C:/xampp/htdocs/db.json');
        $data = json_decode($json_data, true);

        foreach ($data['province'] as $item) {
            // dd($item);
            province::create([
                'id' => $item['idProvince'],
                'name' => $item['name'],
            ]);
        }
        foreach ($data['district'] as $item) {
            district::create([
                'id' => $item['idDistrict'],
                'name' => $item['name'],
                'province_id' => $item['idProvince'],
            ]);
        }
        foreach ($data['commune'] as $item) {
            ward::create([  
                'id' => $item['idCommune'],
                'name' => $item['name'],
                'district_id' => $item['idDistrict'],
            ]);
        }
        return redirect()->route('admin.users');
    }
    public function getDistricts($province_id)
    {
        $province = province::findOrFail($province_id);
        $districts = District::where('province_id', $province_id)->get();
        return response()->json([
            'province_name' => $province->name,
            'districts' => $districts
        ]);
    }

    public function getWards($district_id)
    {
        $district = district::findOrFail($district_id);
        $wards = ward::where('district_id', $district_id)->get();
        return response()->json([
            'district_name' => $district->name,
            'wards' => $wards
        ]);
    }
    public function getWardName($ward_id)
{
    $ward = Ward::findOrFail($ward_id);
    
    return response()->json([
        'ward_name' => $ward->name,
    ]);
}
}
