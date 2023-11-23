<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\donhang;
use App\Models\slider;
use App\Models\hangdt;
use App\Models\binhluan;
use App\Models\khachhang;
use App\Models\lienhe;
use App\Models\chitietdonhang;
use App\Models\tinh;
use App\Models\huyen;
use Session;

class ChitietSPController extends Controller
{
    public function chitietsp(Request $request, $id)
    {
        $sanpham = sanpham::findOrFail($id);
        $lsp = $sanpham->loai_sp;
        $hangdt = hangdt::find($lsp);
        $sld_sp = sanpham::where('loai_sp', $lsp)->where('idsp', '!=', $id)->orderby('soluong_ban', 'desc')->limit(10)->get();

        $item_per_page = $request->has('per_page') ? $request->per_page:5;
        $current_page = $request->has('page') ? $request->page:1;
        $offset = ($current_page - 1) * $item_per_page;
        $binhluan = binhluan::join('khachhangs','binhluans.idkhachhang','=','khachhangs.idkh')
        ->orderby('idbl', 'desc')->where('idsanpham', $id)->limit($item_per_page)->offset($offset)->get();
        $bl = binhluan::where('idsanpham', $id)->get();
        $totalPages = ceil(count($bl) / $item_per_page);
        
        return view('home.chitietsp', compact('sanpham', 'hangdt', 'binhluan', 'sld_sp', 'item_per_page', 'current_page', 'totalPages'));
    }
    public function sanpham()
    {
        $hangdt = hangdt::all();
        return view('home.sanpham', compact('hangdt'));
    }
    public function locsp(Request $request)
    {
        if($request->action != null){
            $hangdt = '';
            $sp = sanpham::whereRaw('soluong-soluong_ban != 0')->orderBy('idsp', 'desc');
            if($request->hangdt != null){
                $hdt = implode("-", $request->hangdt);
                $hdtt = explode('-', $hdt);
                $hangdt = hangdt::whereIn('idhdt', $hdtt)->get();
                $sp->whereIn('loai_sp', $hdtt);
            }
            if($request->gia != null){
                $gia = implode("-", $request->gia);
                $giaa = explode('-', $gia);
                $gia_end = end($giaa);
                $sp->whereBetween('gia_km',[$giaa[0], $gia_end]);
            }
            $sanpham = $sp->get();
            return view('home.locsp', compact('sanpham', 'hangdt'));
        }else{
            return redirect('/sanpham');
        }
    }
    public function binhluan($id)
    {
        if(!Session::has('taikhoan')) {
            return view('home.binhluan');
        }else{
            return redirect('/chitietsp/'.$id);
        }
    }
    public function binhluan_db(Request $request, $id)
    {
        if(!Session::has('taikhoan')) {
            return view('home.binhluan');
        }else{
            $binhluan = new binhluan();
            $binhluan->idsanpham = $id;
            $binhluan->idkhachhang = Session::get('taikhoan')->idkh;
            $binhluan->binhluan = $request->binhluan;
            $binhluan->ngay = date('H:i d-m-Y');
            $binhluan->save();
            return redirect('/chitietsp/'.$id);
        }
    }
    public function xoabl($id)
    {
        if(!Session::has('taikhoan')) {
            return view('home.binhluan');
        }else{
            if(isset($_SERVER['HTTP_REFERER'])){
                $idkh = Session::get('taikhoan')->idkh;
                $binhluan = binhluan::where('idkhachhang', $idkh)->findOrFail($id);
                $binhluan->delete();
                return redirect()->back();
            }else{
                return abort(404);
            }
        }
    }
}
