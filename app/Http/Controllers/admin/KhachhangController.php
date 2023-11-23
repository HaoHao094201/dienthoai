<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\khachhang;
use App\Models\donhang;
use App\Models\binhluan;
use Session;

class KhachhangController extends Controller
{
    public function khachhang(Request $request)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $item_per_page = $request->has('per_page') ? $request->per_page:10;
            $current_page = $request->has('page') ? $request->page:1;
            $offset = ($current_page - 1) * $item_per_page;
            $khachhang = khachhang::orderby('idkh', 'desc')->limit($item_per_page)->offset($offset)->get();
            $kh =  khachhang::all();
            $totalPages = ceil(count($kh) / $item_per_page);
            return view('admin.khachhang.danhsach', compact('khachhang', 'item_per_page', 'current_page', 'totalPages'));
        }
    }
    public function xoa($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            if(isset($_SERVER['HTTP_REFERER'])){
                $dh = donhang::where('idkhachhang', $id)->count();
                $bl = binhluan::where('idkhachhang', $id)->count();
                if($dh == 0 && $bl == 0){
                    $khachhang = khachhang::findOrFail($id);
                    $khachhang->delete();
                    return redirect()->back()->with('mess', 'Xoá khách hàng thành công!');
                }else{
                    return redirect()->back()->with('error', 'Không thể xoá khách hàng này!');
                }
            }else{
                return abort(404);
            }
        }
    }
}
