<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\giamgia;
use Session;

class GiamgiaController extends Controller
{
    public function giamgia(Request $request)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $item_per_page = $request->has('per_page') ? $request->per_page:10;
            $current_page = $request->has('page') ? $request->page:1;
            $offset = ($current_page - 1) * $item_per_page;
            $giamgia = giamgia::orderby('idgg', 'desc')->limit($item_per_page)->offset($offset)->get();
            $gg =  giamgia::all();
            $totalPages = ceil(count($gg) / $item_per_page);
            return view('admin.giamgia.danhsach', compact('giamgia', 'item_per_page', 'current_page', 'totalPages'));
        }
    }
    public function them()
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            return view('admin.giamgia.them');
        }
    }
    public function them_db(Request $request)
    {
        $giamgia = new giamgia();
        $giamgia->magg = $request->input('magg');
        $giamgia->sotien = $request->input('sotien');
        $giamgia->toithieu = $request->input('toithieu');
        $giamgia->gioihan_luot = $request->input('gioihan_luot');
        $giamgia->ngay_hethan = $request->input('ngay_hethan');
        $giamgia->mota = $request->input('mota');
        $giamgia->sl_nhap = 0;
        $Validator = Validator::make($request->all(), [
            'magg' => 'required|max:254',
            'sotien' => 'required|max:10',
            'toithieu' => 'required|max:10',
            'gioihan_luot' => 'required|max:10',
            'mota' => 'required|max:254',
        ]);
        if($Validator->fails()){
            return redirect('/admin/giamgia')->with('error', 'Thêm mã giảm giá thất bại!');
        }else{
            $giamgia->save();
            return redirect('/admin/giamgia')->with('mess', 'Thêm mã giảm giá thành công!');
        }
    }

    public function sua($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $giamgia = giamgia::findOrFail($id);
            return view('admin.giamgia.sua', compact('giamgia'));
        }
    }
    public function sua_db(Request $request, $id)
    {
        $giamgia = array();
        $giamgia['magg'] = $request->magg;
        $giamgia['sotien'] = $request->sotien;
        $giamgia['toithieu'] = $request->toithieu;
        $giamgia['gioihan_luot'] = $request->gioihan_luot;
        $giamgia['ngay_hethan'] = $request->ngay_hethan;
        $giamgia['mota'] = $request->mota;
        $Validator = Validator::make($request->all(), [
            'magg' => 'required|max:254',
            'sotien' => 'required|max:10',
            'toithieu' => 'required|max:10',
            'gioihan_luot' => 'required|max:10',
            'mota' => 'required|max:254',
        ]);
        if($Validator->fails()){
            return redirect('/admin/giamgia')->with('error', 'Cập nhật mã giảm giá thất bại!');
        }else{
            giamgia::where('idgg', $id)->update($giamgia);
            return redirect('/admin/giamgia')->with('mess', 'Cập nhật mã giảm giá thành công!');
        }
    }

    public function xoa($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            if(isset($_SERVER['HTTP_REFERER'])){
                $giamgia = giamgia::findOrFail($id);
                $giamgia->delete();
                return redirect()->back()->with('mess', 'Xoá mã giảm giá thành công!');
            }else{
                return abort(404);
            }
        }
    }
}
