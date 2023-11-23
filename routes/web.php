<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\ChitietSPController;
use App\Http\Controllers\home\DangnhapController;
use App\Http\Controllers\home\GiohangController;
use App\Http\Controllers\home\ThanhtoanController;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\admin\BinhluanController;
use App\Http\Controllers\admin\DonhangController;
use App\Http\Controllers\admin\GiamgiaController;
use App\Http\Controllers\admin\HangdtController;
use App\Http\Controllers\admin\KhachhangController;
use App\Http\Controllers\admin\LienheController;
use App\Http\Controllers\admin\SanphamController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\LoginController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/lienhe', [HomeController::class, 'lienhe']);
Route::post('/lienhe', [HomeController::class, 'lienhe_db']);
Route::get('/ttkh/{id}', [HomeController::class, 'ttkh']);
Route::get('/chitietdh/{id}', [HomeController::class, 'chitietdh']);
Route::get('/trangthai-donhang/{id}', [HomeController::class, 'trangthai_dh']);
Route::get('/timkiem', [HomeController::class, 'timkiem']);

// Thanh toán 
Route::get('/thanhtoan/{id}', [HomeController::class, 'error']);
Route::post('/thanhtoan/{id}', [ThanhtoanController::class, 'thanhtoan']);
Route::get('/vnpay_return', [ThanhtoanController::class, 'vnpay_return']);

// Chi tiết sản phẩm
Route::get('/chitietsp/{id}', [ChitietSPController::class, 'chitietsp']);
Route::get('/binhluan/{id}', [ChitietSPController::class, 'binhluan']);
Route::post('/binhluan/{id}', [ChitietSPController::class, 'binhluan_db']);
Route::get('/xoabl/{id}', [ChitietSPController::class, 'xoabl']);
Route::get('/sanpham', [ChitietSPController::class, 'sanpham']);
Route::post('/sanpham', [ChitietSPController::class, 'locsp']);

// Login home
Route::get('/dangnhap', [HomeController::class, 'error']);
Route::post('/dangnhap', [DangnhapController::class, 'dangnhap']);
Route::get('/dangky', [HomeController::class, 'error']);
Route::post('/dangky', [DangnhapController::class, 'dangky']);
Route::get('/doimk/{id}', [HomeController::class, 'error']);
Route::post('/doimk/{id}', [DangnhapController::class, 'doimk']);
Route::get('/dangxuat', [DangnhapController::class, 'dangxuat']);

// Giỏ hàng
Route::get('/giohang', [GiohangController::class, 'giohang']);
Route::get('/cart/{id}', [HomeController::class, 'error']);
Route::post('/cart/{id}', [GiohangController::class, 'cart']);
Route::get('/xcart/{id}', [GiohangController::class, 'xcart']);
Route::get('/tcart/{id}', [GiohangController::class, 'tcart']);
Route::get('/gcart/{id}', [GiohangController::class, 'gcart']);
Route::get('/dathang', [GiohangController::class, 'dathang']);
Route::post('/dathang', [GiohangController::class, 'dathang_db']);
Route::get('/huyen', [HomeController::class, 'error']);
Route::post('/huyen', [GiohangController::class, 'huyen']);
Route::get('/ktmgg', [HomeController::class, 'error']);
Route::post('/ktmgg', [GiohangController::class, 'ktmgg']);
Route::get('/xmgg', [GiohangController::class, 'xmgg']);

// Admin
Route::get('/admin', [IndexController::class, 'index']);
Route::get('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/login', [LoginController::class, 'login_db']);
Route::get('/admin/logout', [LoginController::class, 'logout']);

// Sản phẩm
Route::get('/admin/sanpham', [SanphamController::class, 'sanpham']);
Route::get('/admin/them-sanpham', [SanphamController::class, 'them']);
Route::post('/admin/them-sanpham', [SanphamController::class, 'them_db']);
Route::get('/admin/sua-sanpham/{id}', [SanphamController::class, 'sua']);
Route::post('/admin/sua-sanpham/{id}', [SanphamController::class, 'sua_db']);
Route::get('/admin/xoa-sanpham/{id}', [SanphamController::class, 'xoa']);
Route::get('/admin/nhaphang/{id}', [SanphamController::class, 'nhaphang']);
Route::post('/admin/nhaphang/{id}', [SanphamController::class, 'nhap']);

// Bình luận
Route::get('/admin/binhluan', [BinhluanController::class, 'binhluan']);
Route::get('/admin/xoa-binhluan/{id}', [BinhluanController::class, 'xoa']);

// Đơn hàng
Route::get('/admin/donhang', [DonhangController::class, 'donhang']);
Route::get('/admin/chitiet-donhang/{id}', [DonhangController::class, 'chitiet']);
Route::get('/admin/huy-donhang/{id}', [DonhangController::class, 'huy']);
Route::get('/admin/trangthai-donhang/{id}', [DonhangController::class, 'trangthai']);

// Giảm giá
Route::get('/admin/giamgia', [GiamgiaController::class, 'giamgia']);
Route::get('/admin/them-giamgia', [GiamgiaController::class, 'them']);
Route::post('/admin/them-giamgia', [GiamgiaController::class, 'them_db']);
Route::get('/admin/sua-giamgia/{id}', [GiamgiaController::class, 'sua']);
Route::post('/admin/sua-giamgia/{id}', [GiamgiaController::class, 'sua_db']);
Route::get('/admin/xoa-giamgia/{id}', [GiamgiaController::class, 'xoa']);

// Hãng đt
Route::get('/admin/hangdt', [HangdtController::class, 'hangdt']);
Route::get('/admin/them-hangdt', [HangdtController::class, 'them']);
Route::post('/admin/them-hangdt', [HangdtController::class, 'them_db']);
Route::get('/admin/sua-hangdt/{id}', [HangdtController::class, 'sua']);
Route::post('/admin/sua-hangdt/{id}', [HangdtController::class, 'sua_db']);
Route::get('/admin/xoa-hangdt/{id}', [HangdtController::class, 'xoa']);

// Khách hàng
Route::get('/admin/khachhang', [KhachhangController::class, 'khachhang']);
Route::get('/admin/xoa-khachhang/{id}', [KhachhangController::class, 'xoa']);

// Liên hệ
Route::get('/admin/lienhe', [LienheController::class, 'lienhe']);
Route::get('/admin/chitiet-lienhe/{id}', [LienheController::class, 'chitiet']);
Route::get('/admin/xoa-lienhe/{id}', [LienheController::class, 'xoa']);

// Slider
Route::get('/admin/slider', [SliderController::class, 'slider']);
Route::get('/admin/them-slider', [SliderController::class, 'them']);
Route::post('/admin/them-slider', [SliderController::class, 'them_db']);
Route::get('/admin/sua-slider/{id}', [SliderController::class, 'sua']);
Route::post('/admin/sua-slider/{id}', [SliderController::class, 'sua_db']);
Route::get('/admin/xoa-slider/{id}', [SliderController::class, 'xoa']);

