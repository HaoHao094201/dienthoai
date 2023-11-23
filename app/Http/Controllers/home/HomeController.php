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

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $item_per_page = $request->has('per_page') ? $request->per_page:8;
        $current_page = $request->has('page') ? $request->page:1;
        $offset = ($current_page - 1) * $item_per_page;
        $sanpham = sanpham::orderBy('idsp', 'desc')->limit($item_per_page)->offset($offset)->get();
        $sp =  sanpham::all();
        $totalPages = ceil(count($sp) / $item_per_page);

        $slider = slider::all();
        $spkm = sanpham::where('gia_km', '!=', 0)->orderByRaw('(gia - gia_km) desc')->limit(10)->get();
        $spvip = sanpham::orderby('soluong_ban', 'desc')->limit(4)->get();
        return view('home.index', compact('sanpham', 'slider', 'spkm', 'spvip', 'item_per_page', 'current_page', 'totalPages'));
    }
    public function lienhe()
    {
        return view('home.lienhe');
    }
    public function lienhe_db(Request $request)
    {
        $lienhe = new lienhe();
        $lienhe->ten = $request->input('ten');
        $lienhe->tieude = $request->input('tieude');
        $lienhe->sdt = $request->input('sdt');
        $lienhe->email = $request->input('email');
        $lienhe->noidung = $request->input('noidung');
        $lienhe->ngay = date('H:i d-m-Y');
        $lienhe->save();
        return redirect('/lienhe')->with('mess', 'Yêu cầu của bạn đã được gửi đi!');
    }
    public function ttkh(Request $request, $id)
    {
        if(!Session::has('taikhoan')) {
            return view('home.ttkh');
        }else{
            $email = Session::get('taikhoan')->email;
            $khachhang = khachhang::where('email', $email)->findOrFail($id);

            $item_per_page = $request->has('per_page') ? $request->per_page:10;
            $current_page = $request->has('page') ? $request->page:1;
            $offset = ($current_page - 1) * $item_per_page;
            $donhang = donhang::join('khachhangs','donhangs.idkhachhang','=','khachhangs.idkh')->where('idkhachhang', $id)
            ->orderby('iddh', 'desc')->limit($item_per_page)->offset($offset)->get();
            $dh = donhang::where('idkhachhang', $id)->get();
            $totalPages = ceil(count($dh) / $item_per_page);

            return view('home.ttkh', compact('khachhang', 'donhang', 'item_per_page', 'current_page', 'totalPages'));
        }
    }
    public function chitietdh($id)
    {
        if(!Session::has('taikhoan')) {
            return view('home.chitietdh');
        }else{
            $ctdh = chitietdonhang::join('sanphams','chitietdonhangs.idsanpham','=','sanphams.idsp')->where('iddonhang', $id)->get();
            $donhang = donhang::findOrFail($id);
            $kh = $donhang->idkhachhang;
            $khachhang = khachhang::find($kh);
            $t = $donhang->idtinh;
            $tinh = tinh::find($t);
            $h = $donhang->idhuyen;
            $huyen = huyen::find($h);
            return view('home.chitietdh', compact('donhang', 'khachhang', 'tinh', 'huyen', 'ctdh'));

        }
    }
    public function trangthai_dh(Request $request, $id)
    {
        if(Session::has('taikhoan')) {
            if(isset($_SERVER['HTTP_REFERER'])){
                $donhang = donhang::findOrFail($id);
                $trangthai = $donhang->trangthai;
                if($trangthai == 0 || $trangthai == 1)
                {
                    $dh = array();
                    $dh['trangthai'] = 5;
                    donhang::where('iddh', $id)->update($dh);
                }
                return redirect()->back();
            }else{
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }
    public function timkiem(Request $request)
    {
        $timkiem = $request->timkiem;
        $item_per_page = $request->has('per_page') ? $request->per_page:12;
        $current_page = $request->has('page') ? $request->page:1;
        $offset = ($current_page - 1) * $item_per_page;
        $sanpham = sanpham::where('tensp', 'like', '%' .$timkiem. '%')->orderBy('idsp', 'desc')->limit($item_per_page)->offset($offset)->get();
        $sp = sanpham::where('tensp', 'like', '%' .$timkiem. '%')->get();
        $totalPages = ceil(count($sp) / $item_per_page);
        return view('home.timkiem', compact('sanpham', 'timkiem', 'sp', 'item_per_page', 'current_page', 'totalPages'));
    }
    public function error()
    {
        return abort(404);
    }
}
