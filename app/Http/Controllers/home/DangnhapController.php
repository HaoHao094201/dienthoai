<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\khachhang;
use Session;

class DangnhapController extends Controller
{
    public function dangnhap(Request $request)
    {
        $email = $request->input('email');
        $matkhau = md5($request->input('matkhau'));
        $user = khachhang::where('email', $email)->where('matkhau', $matkhau)->first();
        if($user) {
            Session::put('taikhoan', $user);
            return redirect()->back();
        }
        else{
            return redirect()->back()->with('errdn', 'Email hoặc mật khẩu không chính xác!');
        }
    }
    public function dangky(Request $request)
    {
        $errdk = array();
        $khachhang = new khachhang();
        $khachhang->tenkh = $request->input('tenkh');
        $khachhang->email = $request->input('email');
        $matkhau = $request->input('matkhau');
        $re_matkhau = $request->input('re_matkhau');
        $khachhang->sdt = $request->input('sdt');
        $kh = khachhang::where('email', $khachhang->email)->first();
        if($kh){
            $errdk['email'] = "Email này đã có khách hàng sử dụng!";
        }
        if(empty($khachhang->tenkh)){
			$errdk['tenkh'] = "Bạn chưa nhập tên!";
		}
		if(empty($matkhau)){
			$errdk['matkhau'] = "Bạn chưa nhập mật khẩu!";
		}
		if(empty($re_matkhau)){
			$errdk['re_matkhau'] = "Bạn chưa nhập lại mật khẩu!";
		}
		if($matkhau != $re_matkhau && strlen($re_matkhau) != 0){
			$errdk['re_matkhau'] = "Nhập lại mật khẩu không đúng!";
		}
		if(empty($khachhang->email)){
			$errdk['email'] = "Bạn chưa nhập email!";
		}
		if(empty($khachhang->sdt)){
			$errdk['sdt'] = "Bạn chưa nhập số điện thoại!";
		}
		if(strlen($matkhau) > 12 || strlen($matkhau) < 6 && strlen($matkhau) != 0){
			$errdk['matkhau'] = "Mật khẩu dài từ 6-12 ký tự";
		}
		if(strlen($khachhang->tenkh) > 25 || strlen($khachhang->tenkh) < 6 && strlen($khachhang->tenkh) != 0){
			$errdk['tenkh'] = "Họ tên dài từ 6-25 ký tự";
		}
		if(strlen($khachhang->email) > 30 || strlen($khachhang->email) < 6 && strlen($khachhang->email) != 0){
			$errdk['email'] = "Email dài từ 6-30 ký tự";
		}
		if(strlen($khachhang->sdt) > 12 || strlen($khachhang->sdt) < 6 && strlen($khachhang->sdt) != 0){
			$errdk['sdt'] = "Số điện thoại dài từ 6-12 ký tự";
		}
        if(empty($errdk)){
            $khachhang->matkhau = md5($matkhau);
            $khachhang->save();
            return redirect()->back()->with('tb', 'Đăng ký thành công!');
        }else{
            return redirect()->back()->with('errdk', $errdk);
        }
    }
    public function doimk(Request $request, $id)
    {
        $errdmk = array();
        $khachhang = array();
        $email = Session::get('taikhoan')->email;
        $matkhau_c = $request->matkhau_c;
        $matkhau_m = $request->matkhau_m;
        $re_matkhau_m = $request->re_matkhau_m;
        $mkc = md5($matkhau_c);
        $kh = khachhang::where('email', $email)->where('matkhau', $mkc)->get();
        if(count($kh) <= 0){
			$errdmk['matkhau_c'] = "Mật khẩu hiện tại không đúng!";
		}
		if(empty($matkhau_c)){
			$errdmk['matkhau_c'] = "Bạn chưa nhập mật khẩu hiện tại!";
		}
        if(empty($matkhau_m)){
			$errdmk['matkhau_m'] = "Bạn chưa nhập mật khẩu mới!";
		}
		if(empty($re_matkhau_m)){
			$errdmk['re_matkhau_m'] = "Bạn chưa nhập lại mật khẩu mới!";
		}
		if($matkhau_m != $re_matkhau_m && strlen($re_matkhau_m) != 0){
			$errdmk['re_matkhau_m'] = "Nhập lại mật khẩu mới không đúng!";
		}
		if(strlen($matkhau_m) > 12 || strlen($matkhau_m) < 6 && strlen($matkhau_m) != 0){
			$errdmk['matkhau_m'] = "Mật khẩu dài từ 6-12 ký tự";
		}
		if(empty($errdmk)){
            $khachhang['matkhau'] = md5($matkhau_m);
            khachhang::where('idkh', $id)->update($khachhang);
            return redirect()->back()->with('mess', 'Cập nhật thành công!');
        }else{
            return redirect()->back()->with('errdmk', $errdmk);
        }
    }
    public function dangxuat()
    {
        Session::forget('taikhoan');
        return Redirect('/');
    }
}
