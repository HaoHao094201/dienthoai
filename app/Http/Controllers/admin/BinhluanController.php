<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\binhluan;
use App\Models\sanpham;
use App\Models\khachhang;
use Session;

class BinhluanController extends Controller
{
    public function binhluan(Request $request)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $item_per_page = $request->has('per_page') ? $request->per_page:10;
            $current_page = $request->has('page') ? $request->page:1;
            $offset = ($current_page - 1) * $item_per_page;
            $binhluan = binhluan::join('sanphams','binhluans.idsanpham','=','sanphams.idsp')
            ->join('khachhangs','binhluans.idkhachhang','=','khachhangs.idkh')
            ->orderby('idbl', 'desc')->limit($item_per_page)->offset($offset)->get();
            $bl =  binhluan::all();
            $totalPages = ceil(count($bl) / $item_per_page);
            return view('admin.binhluan.danhsach', compact('binhluan', 'item_per_page', 'current_page', 'totalPages'));
        }
    }
    public function xoa($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            if(isset($_SERVER['HTTP_REFERER'])){
                $binhluan = binhluan::findOrFail($id);
                $binhluan->delete();
                return redirect()->back()->with('mess', 'Xoá bình luận thành công!');
            }else{
                return abort(404);
            }
        }
    }
}
