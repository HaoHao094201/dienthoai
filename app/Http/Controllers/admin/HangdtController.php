<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\hangdt;
use App\Models\sanpham;
use Illuminate\Support\Facades\Validator;
use Session;

class HangdtController extends Controller
{
    public function hangdt(Request $request)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $item_per_page = $request->has('per_page') ? $request->per_page:10;
            $current_page = $request->has('page') ? $request->page:1;
            $offset = ($current_page - 1) * $item_per_page;
            $hangdt = hangdt::limit($item_per_page)->offset($offset)->get();
            $hdt =  hangdt::all();
            $totalPages = ceil(count($hdt) / $item_per_page);
            return view('admin.hangdt.danhsach', compact('hangdt', 'item_per_page', 'current_page', 'totalPages'));
        }
    }
    public function them()
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            return view('admin.hangdt.them');
        }
    }
    public function them_db(Request $request)
    {
        $hangdt = new hangdt();
        $hangdt->tenloai = $request->input('tenloai');
        $Validator = Validator::make($request->all(), [
            'tenloai' => 'required|max:254',
        ]);
        if($Validator->fails()){
            return redirect('/admin/hangdt')->with('error', 'Thêm loại sản phẩm thất bại!');
        }else{
            $hangdt->save();
            return redirect('/admin/hangdt')->with('mess', 'Thêm loại sản phẩm thành công!');
        }
    }

    public function sua($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $hangdt = hangdt::findOrFail($id);
            return view('admin.hangdt.sua', compact('hangdt'));
        }
    }
    public function sua_db(Request $request, $id)
    {
        $hangdt = array();
        $hangdt['tenloai'] = $request->tenloai;
        $Validator = Validator::make($request->all(), [
            'tenloai' => 'required|max:254',
        ]);
        if($Validator->fails()){
            return redirect('/admin/hangdt')->with('error', 'Cập nhật loại sản phẩm thất bại!');
        }else{
            hangdt::where('idhdt', $id)->update($hangdt);
            return redirect('/admin/hangdt')->with('mess', 'Cập nhật loại sản phẩm thành công!');
        }
    }

    public function xoa($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            if(isset($_SERVER['HTTP_REFERER'])){
                $sp = sanpham::where('loai_sp', $id)->count();
                if($sp == 0){
                    $hangdt = hangdt::findOrFail($id);
                    $hangdt->delete();
                    return redirect()->back()->with('mess', 'Xoá loại sản phẩm thành công!');
                }else{
                    return redirect()->back()->with('error', 'Không thể xoá loại sản phẩm này!');
                }
            }else{
                return abort(404);
            }
        }
    }
}
