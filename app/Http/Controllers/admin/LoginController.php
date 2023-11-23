<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
    public function login_db(Request $request)
    {
        $TaiKhoan = $request->input('TaiKhoan');
        $MatKhau = $request->input('MatKhau');
        $user = user::where('TaiKhoan', $TaiKhoan)->where('MatKhau', $MatKhau)->first();
        if($user) {
            Session::put('TaiKhoan', $user);
            return redirect('/admin');
        }
        else{
            return redirect('/admin/login')->with('error', 'Tài khoản hoặc mật khẩu không chính xác!');
        }
    }
    public function logout()
    {
        Session::forget('TaiKhoan');
        return Redirect('/admin/login');
    }
}
