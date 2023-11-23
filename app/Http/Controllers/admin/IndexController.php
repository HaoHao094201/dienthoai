<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use Illuminate\Support\Facades\Redirect;
use App\Models\sanpham;
use App\Models\lienhe;
use App\Models\donhang;
use Session;

class IndexController extends Controller
{
    public function index()
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $sanpham = sanpham::all();
            $donhang = donhang::all();
            $lienhe = lienhe::all();
            $tt = donhang::where('trangthai', 3)->get();
            return view('admin.index', compact('sanpham', 'donhang', 'tt', 'lienhe'));
        }
    }
}
