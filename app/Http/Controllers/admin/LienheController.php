<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\lienhe;
use Session;

class LienheController extends Controller
{
    public function lienhe(Request $request)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $item_per_page = $request->has('per_page') ? $request->per_page:10;
            $current_page = $request->has('page') ? $request->page:1;
            $offset = ($current_page - 1) * $item_per_page;
            $lienhe = lienhe::orderby('idlh', 'desc')->limit($item_per_page)->offset($offset)->get();
            $lh =  lienhe::all();
            $totalPages = ceil(count($lh) / $item_per_page);
            return view('admin.lienhe.danhsach', compact('lienhe', 'item_per_page', 'current_page', 'totalPages'));
        }
    }
    public function chitiet($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $lienhe = lienhe::findOrFail($id);
            return view('admin.lienhe.chitiet', compact('lienhe'));
        }
    }
    public function xoa($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            if(isset($_SERVER['HTTP_REFERER'])){
                $lienhe = lienhe::findOrFail($id);
                $lienhe->delete();
                return redirect()->back()->with('mess', 'Xoá liên hệ thành công!');
            }else{
                return abort(404);
            }
        }
    }
}
