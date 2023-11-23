<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\sanpham;
use App\Models\chitietdonhang;
use App\Models\donhang;
use App\Models\khachhang;
use App\Models\tinh;
use App\Models\huyen;
use Session;

class DonhangController extends Controller
{
    public function donhang(Request $request)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $item_per_page = $request->has('per_page') ? $request->per_page:10;
            $current_page = $request->has('page') ? $request->page:1;
            $offset = ($current_page - 1) * $item_per_page;
            $donhang = donhang::join('khachhangs','donhangs.idkhachhang','=','khachhangs.idkh')
            ->orderby('iddh', 'desc')->limit($item_per_page)->offset($offset)->get();
            $dh =  donhang::all();
            $totalPages = ceil(count($dh) / $item_per_page);
            return view('admin.donhang.danhsach', compact('donhang', 'item_per_page', 'current_page', 'totalPages'));
        }
    }
    public function chitiet($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $ctdh = chitietdonhang::join('sanphams','chitietdonhangs.idsanpham','=','sanphams.idsp')->where('iddonhang', $id)->get();
            $donhang = donhang::findOrFail($id);
            $kh = $donhang->idkhachhang;
            $khachhang = khachhang::find($kh);
            $t = $donhang->idtinh;
            $tinh = tinh::find($t);
            $h = $donhang->idhuyen;
            $huyen = huyen::find($h);
            $giamgia = $donhang->giamgia;
            $gia_ship = $donhang->gia_ship;
            return view('admin.donhang.chitiet', compact('donhang', 'khachhang', 'tinh', 'huyen', 'ctdh', 'giamgia', 'gia_ship'));
        }
    }
    public function trangthai(Request $request, $id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            if(isset($_SERVER['HTTP_REFERER'])){
                $donhang = donhang::findOrFail($id);
                $trangthai = $donhang->trangthai;
                if($trangthai == 1)
                {
                    $dh = array();
                    $dh['trangthai'] = 2;
                    donhang::where('iddh', $id)->update($dh);
                    return redirect()->back()->with('mess', 'Đơn hàng #'.$donhang->madh.' đã được xét duyệt!');
                }
                else if($trangthai == 2)
                {
                    $dh = array();
                    $dh['trangthai'] = 3;
                    donhang::where('iddh', $id)->update($dh);
                    $ctdh = chitietdonhang::join('sanphams','chitietdonhangs.idsanpham','=','sanphams.idsp')->where('iddonhang', $id)->get();
                    foreach ($ctdh as $row) {
                        $idsp = $row->idsanpham;
                        $soluong_ban = $row->soluong_ban + $row->soluong_m;
                        $sp = array();
                        $sp['soluong_ban'] = $soluong_ban;
                        sanpham::where('idsp', $idsp)->update($sp);
                    }
                    return redirect()->back()->with('mess', 'Đơn hàng #'.$donhang->madh.' đã được giao thành công!');
                }
            }else{
                return abort(404);
            }
        }
    }
    public function huy(Request $request, $id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            if(isset($_SERVER['HTTP_REFERER'])){
                $donhang = donhang::findOrFail($id);
                $trangthai = $donhang->trangthai;
                if($trangthai == 0 || $trangthai == 1)
                {
                    $dh = array();
                    $dh['trangthai'] = 4;
                    donhang::where('iddh', $id)->update($dh);
                }
                return redirect()->back()->with('mess', 'Đã huỷ đơn hàng #'.$donhang->madh.'!');
            }else{
                return abort(404);
            }
        }
    }
}
