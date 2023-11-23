@extends('home.layout')
@section('content')
    @if(!Session::has('taikhoan'))
        <script>
            $(document).ready(function(){
            $('#myModal').modal(); 
            });
        </script>
        <section id="main">
            <div class="cart-info">
                Bạn cần đăng nhập để sử dụng chức năng này !
                <div class="button-order">
                    <button type="submit" name="sbm" class="button btn-cart add_to_cart_detail detail-button" data-toggle="modal" data-target="#myModal">Đăng nhập</button>
                </div>
            </div>
        </section>
    @else 
		@if(Session::has('mess'))
			<script>alert("{{ Session::get('mess') }}"); </script>
		@endif
		<section id="main">
			<div class="container order-page">
				<div class="breadcrumbs">
					<ul>
						<li class="home"><a href="/" title="Go to Home Page">Trang chủ</a> / </li>
						<li><a href="/ttkh/{{ Session::get('taikhoan')->idkh }}">Tài khoản của tôi</a> / </li>
						<li>Đơn hàng của tôi</li>
					</ul>
				</div>
				<div class="col-sm-4">
					<div class="myorder">
						<div class="name-all">
							<h1>Thông tin nhận hàng</h1>
						</div>
						<div class="content-order" style="padding:15px;">
							<div class="ct"><span>Người nhận:</span><span>{{ $khachhang->tenkh }} - {{ $khachhang->sdt }}</span></div>
							<div class="ct"><span>Đặt lúc:</span><span>{{ $donhang->ngay_dat }}</span></div>
							<div class="ct"><span>Địa chỉ:</span><span>{{ $donhang->diachi }}, {{ $huyen->ten_h }}, {{ $tinh->ten_t }}</span></div>
						</div>
					</div>
				</div>
				<div class="myorder1 col-md-8">
					<div class="name-all" style="display: flex;justify-content: space-between;">
						<h1>Thông tin đơn hàng - #{{ $donhang->madh }}</h1>
						@switch ($donhang->trangthai) 
							@case ('0')
								<b style="color:#1cac53;padding: 14px 23px 14px 0;font-size: 16px;display: flex;align-items: flex-end;">Chờ thanh toán</b>
								@break
							@case ('1')
								<b style="color:#1cac53;padding: 14px 23px 14px 0;font-size: 16px;display: flex;align-items: flex-end;">Đã thanh toán</b>
								@break
							@case ('2')
								<b style="color:#1cac53;padding: 14px 23px 14px 0;font-size: 16px;display: flex;align-items: flex-end;">Đang giao hàng</b>
								@break
							@case ('3')
								<b style="color:#1cac53;padding: 14px 23px 14px 0;font-size: 16px;display: flex;align-items: flex-end;">Hoàn thành</b>
								@break
							@case ('4')
								<b style="color:#d0021b;padding: 14px 23px 14px 0;font-size: 16px;display: flex;align-items: flex-end;">Đã huỷ</b>
								@break
							@case ('5')
								<b style="color:#d0021b;padding: 14px 23px 14px 0;font-size: 16px;display: flex;align-items: flex-end;">Đã huỷ</b>
								@break
						@endswitch
					</div>
					<div class="content-order1" style="padding:15px;">
						<div class="content1">	
							<?php $tongtien = 0; ?>
							@foreach ($ctdh as $dh)
								@if($dh->gia_km > 0)
									<?php $gia = $dh->gia_km * $dh->soluong_m ?>
								@else
									<?php $gia = $dh->gia * $dh->soluong_m ?>
								@endif
								<?php $tongtien += $gia; ?>
								<div class="content2">
									<a href="/chitietsp/{{ $dh->idsp }}">
										<img style="width: 70px" src="{{asset('storage/img/sanpham/'.$dh->img)}}">
									</a>
									<div>
										<a href="/chitietsp/{{ $dh->idsp }}" style="font-size:15px;">{{ $dh->tensp }}</a>
										<p style="font-size:12px;">Số lượng: {{ $dh->soluong_m }}</p>
									</div>
									<div class="gia-sp">
										@if($dh->gia_km > 0)
											<span>{{ number_format($dh->gia_km) }}₫</span>
											<span style="text-decoration: line-through;font-size:12px;">{{ number_format($dh->gia) }}₫</span>
										@else
											<span>{{ number_format($dh->gia) }}₫</span>
										@endif
									</div>
								</div>
							@endforeach
						</div>
						<form method="POST" action="/thanhtoan/{{ $donhang->iddh }}" target="_blank">@csrf
							<div style="display: flex;justify-content: flex-end;border-bottom: 1px solid #f1f1f1;">
								<div class="col-sm-6">
									<div class="content-order2">
										<table class="table" style="margin: 0;">
											<tbody>
												<tr>
													<td>Tổng:</td>
													<td class="text-right"><span>{{ number_format($tongtien) }}₫</span></td>
												</tr>
												<tr>
													<td>Phí giao hàng:</td>
													<td class="text-right">{{ number_format($donhang->gia_ship) }}₫</span></td>
												</tr>
												@if($donhang->giamgia != 0)
												<tr>
													<td>Voucher :</td><td class="text-right">-{{ number_format($donhang->giamgia) }}₫</td>
												</tr>
												@endif
												<tr>
													<td>Tổng thanh toán:</td>
													<td class="text-right"><span style="color: red; font-size: 18px;">{{ number_format($donhang->tongtien) }}₫</span></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							@if($donhang->trangthai == 0)
								<div class="button-order" style="justify-content: flex-end;margin: 15px 8px 0 15px;">
									<button type="submit" name="redirect" style="font-size: 14px;height: 35px;width: 160px;" class="button btn-cart add_to_cart_detail detail-button">Thanh toán</button>
								</div>
							@endif
						</form>
						@if($donhang->trangthai == 0 || $donhang->trangthai == 1)
							<div class="can" style="display: flex;justify-content: flex-end;margin: 15px 8px 0 15px;">
								<a style="color: red;" href="/trangthai-donhang/{{ $donhang->iddh }}" onclick="return confirm('Xác nhận hủy đơn hàng này ?')"><button class="btn" style="height: 35px;border: 1px solid #cbd1d6;background: #fff;">Huỷ đơn hàng</button></a>
							</div>
						@endif
					</div>
				</div>
			</div>
		</section>
	@endif
@endsection

