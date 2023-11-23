<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\sanpham;
use App\Models\hangdt;
use App\Models\chitietdonhang;
use App\Models\binhluan;
use Session;

class SanphamController extends Controller
{
    public function sanpham(Request $request)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $item_per_page = $request->has('per_page') ? $request->per_page:10;
            $current_page = $request->has('page') ? $request->page:1;
            $offset = ($current_page - 1) * $item_per_page;
            $sanpham = sanpham::join('hangdts','sanphams.loai_sp','=','hangdts.idhdt')
            ->orderby('idsp', 'desc')->limit($item_per_page)->offset($offset)->get();
            $sp =  sanpham::all();
            $totalPages = ceil(count($sp) / $item_per_page);
            return view('admin.sanpham.danhsach', compact('sanpham', 'item_per_page', 'current_page', 'totalPages'));
        }
    }

    public function them()
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $hangdt = hangdt::all();
            return view('admin.sanpham.them', compact('hangdt'));
        }
    }
    public function them_db(Request $request)
    {
        $sanpham = new sanpham();
        $sanpham->tensp = $request->input('tensp');
        $sanpham->gia = $request->input('gia');
        $sanpham->soluong = $request->input('soluong');
        $sanpham->loai_sp = $request->input('loai_sp');
        $sanpham->gia_km = $request->input('gia_km');
        $sanpham->mota = $request->input('mota');
        $sanpham->soluong_ban = 0;
        $image = $request->file('img');
        if($image != null) {
            $image_file = $image->getClientOriginalName();
            $image->move('storage/img/sanpham/',$image_file);
            $sanpham->img = $image_file;
        }
        else {
            $sanpham->img = '';
        }
        $Validator = Validator::make($request->all(), [
            'tensp' => 'required|max:254',
            'gia' => 'required|max:10',
            'soluong' => 'required|max:10',
            'gia_km' => 'required|max:10',
        ]);
        if($Validator->fails()){
            return redirect('/admin/sanpham')->with('error', 'Thêm sản phẩm thất bại!');
        }else{
            $sanpham->save();
            return redirect('/admin/sanpham')->with('mess', 'Thêm sản phẩm thành công!');
        }
    }

    public function nhaphang($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $sanpham = sanpham::findOrFail($id);
            $lsp = $sanpham->loai_sp;
            $hangdt = hangdt::find($lsp);
            return view('admin.sanpham.nhaphang', compact('sanpham', 'hangdt'));
        }
    }
    public function nhap(Request $request, $id)
    {
        $sanpham = sanpham::findOrFail($id);
        $soluong = $sanpham->soluong;
        $sp = array();
        $sp['soluong'] = $soluong + $request->soluong;
        $Validator = Validator::make($request->all(), [
            'soluong' => 'required|max:10',
        ]);
        if($Validator->fails()){
            return redirect('/admin/sanpham')->with('error', 'Cập nhật sản phẩm thất bại!');
        }else{
            sanpham::where('idsp', $id)->update($sp);
            return redirect('/admin/sanpham')->with('mess', 'Cập nhật sản phẩm thành công!');
        }
    }

    public function sua($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $sanpham = sanpham::findOrFail($id);
            $hangdt = hangdt::all();
            return view('admin.sanpham.sua', compact('hangdt','sanpham'));
        }
    }
    public function sua_db(Request $request, $id)
    {
        $sanpham = array();
        $sanpham['tensp'] = $request->tensp;
        $sanpham['gia'] = $request->gia;
        $sanpham['soluong'] = $request->soluong;
        $sanpham['loai_sp'] = $request->loai_sp;
        $sanpham['gia_km'] = $request->gia_km;
        $sanpham['mota'] = $request->mota;
        $image = $request->file('img');
        if($image != null) {
            $image_file = $image->getClientOriginalName();
            $image->move('storage/img/sanpham/',$image_file);
            $sanpham['img'] = $image_file;
        }
        else {
            $sanpham['img'] = '';
        }
        $Validator = Validator::make($request->all(), [
            'tensp' => 'required|max:254',
            'gia' => 'required|max:10',
            'soluong' => 'required|max:10',
            'gia_km' => 'required|max:10',
        ]);
        if($Validator->fails()){
            return redirect('/admin/sanpham')->with('error', 'Cập nhật sản phẩm thất bại!');
        }else{
            sanpham::where('idsp', $id)->update($sanpham);
            return redirect('/admin/sanpham')->with('mess', 'Cập nhật sản phẩm thành công!');
        }
    }

    public function xoa($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            if(isset($_SERVER['HTTP_REFERER'])){
                $ctsp = chitietdonhang::where('idsanpham', $id)->count();
                $bl = binhluan::where('idsanpham', $id)->count();
                if($ctsp == 0 && $bl == 0){
                    $sanpham = sanpham::findOrFail($id);
                    $sanpham->delete();
                    return redirect()->back()->with('mess', 'Xoá sản phẩm thành công!');
                }else{
                    return redirect()->back()->with('error', 'Không thể xoá sản phẩm này!');
                }
            }else{
                return abort(404);
            }
        }
    }
}
