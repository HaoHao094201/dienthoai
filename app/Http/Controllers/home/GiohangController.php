<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\chitietdonhang;
use App\Models\donhang;
use App\Models\tinh;
use App\Models\huyen;
use App\Models\giamgia;
use Session;

class GiohangController extends Controller
{
    public function giohang()
    {
        Session::forget('giamgia');
        return view('home.giohang');
    }
    public function cart(Request $request, $id)
    {
        $sanpham = sanpham::findOrFail($id);
        $sp = [
            'idsp' => $id,
            'img' => $sanpham->img,
            'tensp' => $sanpham->tensp,
            'gia'=> $sanpham->gia,
            'gia_km' => $sanpham->gia_km,
            'soluong' => 1,
            'gia_ship' => 30000,
        ];
        $cart = Session::get('giohang');
        if(isset($cart[$id])){
            $cart[$id]['soluong'] += 1;
		    Session::put('giohang', $cart);
        }else{
            $cart[$id] = $sp;
		    Session::put('giohang', $cart);
        }
        return redirect()->back();
    }
    public function xcart($id)
    {
        if(isset($_SERVER['HTTP_REFERER'])){
            $cart = Session::get('giohang');
            unset($cart[$id]);
            Session::put('giohang' , $cart);
            return redirect('/giohang');
        }else{
            return abort(404);
        }
    }
    public function tcart($id)
    {
        if(isset($_SERVER['HTTP_REFERER'])){
            $cart = Session::get('giohang');
            if($cart[$id]['soluong'] < 10){
                $cart[$id]['soluong'] += 1;
            }
            Session::put('giohang' , $cart);
            return redirect('/giohang');
        }else{
            return abort(404);
        }
    }
    public function gcart($id)
    {
        if(isset($_SERVER['HTTP_REFERER'])){
            $cart = Session::get('giohang');
            if($cart[$id]['soluong'] > 1){
                $cart[$id]['soluong'] -= 1;
            }
            Session::put('giohang' , $cart);
            return redirect('/giohang');
        }else{
            return abort(404);
        }
    }
    public function huyen(Request $request)
    {
        $idt = $request->idt;
        $huyen = huyen::where('idtinh', $idt)->get();
        return view('home.huyen', compact('huyen'));
    }
    public function ktmgg(Request $request)
    {
        $magg = $request->magg;
        $date = getdate();
        $ngay = $date['year']."-".$date['mon']."-".$date['mday'];
        $giamgia = giamgia::where('magg', $magg)->first();
        return view('home.ktmgg', compact('giamgia', 'ngay', 'magg'));
    }
    public function xmgg()
    {
        Session::forget('giamgia');
        return redirect('/dathang');
    }
    public function dathang()
    {
        if(Session::get('giohang') != null){
            $tinh = tinh::all();
            return view('home.dathang', compact('tinh'));
        }else{
            return redirect('/giohang');
        }
    }
    public function dathang_db(Request $request)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = '';
        for( $i = 0; $i < 6; $i++ ) {
            $str .= $chars[ rand( 0, strlen( $chars ) - 1 ) ];
        }
        $giamgia = array();
        $donhang = new donhang();
        $donhang->madh = str_shuffle($str);
        $donhang->idkhachhang = Session::get('taikhoan')['idkh'];
        $donhang->ngay_dat = date('H:i d-m-Y');
        $donhang->idtinh = $request->idtinh;
        $donhang->idhuyen = $request->idhuyen;
        $donhang->diachi = $request->diachi;
        $donhang->trangthai = 0;
        if(Session::has('giamgia')){
            $donhang->giamgia = Session::get('giamgia')['sotien'];
            $gia = 0;
            foreach(Session::get('giohang') as $rowsp ){
                if($rowsp['gia_km'] > 0){
                    $gia += $rowsp['gia_km']*$rowsp['soluong'];
                }else{
                    $gia += $rowsp['gia']*$rowsp['soluong'];
                }
                $donhang->tongtien = $gia + $rowsp['gia_ship'] - $donhang->giamgia;
            }
        }else{
            $donhang->giamgia = 0;
            $gia = 0;
            foreach(Session::get('giohang') as $rowsp ){
                if($rowsp['gia_km'] > 0){
                    $gia += $rowsp['gia_km']*$rowsp['soluong'];
                }else{
                    $gia += $rowsp['gia']*$rowsp['soluong'];
                }
                $donhang->tongtien = $gia + $rowsp['gia_ship'] - $donhang->giamgia;
            }
        }
        $donhang->gia_ship = $rowsp['gia_ship'];
        $donhang->save();
        if($donhang){
            foreach(Session::get('giohang') as $rowsp ){
                $ctdh = new chitietdonhang();
                $ctdh->iddonhang = $donhang->iddh;
                $ctdh->idsanpham = $rowsp['idsp'];
                $ctdh->soluong_m = $rowsp['soluong'];
                $ctdh->save();
            }
            if(Session::has('giamgia')){
                $idgg = Session::get('giamgia')['idgg'];
                $gg = giamgia::find($idgg);
                $giamgia['sl_nhap'] = $gg->sl_nhap + 1;
                giamgia::where('idgg', $idgg)->update($giamgia);
            }
            Session::forget('giohang');
            Session::forget('giamgia');
            return redirect('/chitietdh/' .$ctdh->iddonhang)->with('mess', 'Đặt hàng thành công!');
        }
    }
}
