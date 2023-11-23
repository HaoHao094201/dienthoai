@extends('home.layout')
@section('content')
@if(Session::get('giohang') != null)
	<section id="main">
		<div class="container" style="padding: 0 150px;">
			<div class="breadcrumbs">
				<ul>
					<li class="home"><a href="/" title="Go to Home Page">Trang chủ</a> / </li>
					<li class="category3">Giỏ hàng</li>
				</ul>
			</div>
			<form action="" method="post" id="cartformpage">
				<div class="cart-index">
					<div class="name-all">
						<h1>Có {{ count(Session::get('giohang')) }} sản phẩm trong giỏ hàng</h1>
					</div>
					<div class="cart-product" style="padding: 0 15px;">
						<table class="table table-list-product">
							<thead>
								<tr style="background: #f3f3f3;">
									<th class="text-center">Hình ảnh</th>
									<th>Tên sản phẩm</th>
									<th class="text-center">Đơn giá</th>
									<th class="text-center">Số lượng</th>
									<th class="text-center">Tổng tiền</th>
									<th class="text-center">Xóa</th>
								</tr>
							</thead>
							<tbody>
								@foreach(Session::get('giohang') as $rowsp )
									<tr>
										<td class="img-product-cart text-center">
											<a href="/chitietsp/{{ $rowsp['idsp'] }}">
												<img style="width: 70px" src="{{asset('storage/img/sanpham/'.$rowsp['img'])}}" alt="">
											</a>
										</td>
										<td>
											<a href="/chitietsp/{{ $rowsp['idsp'] }}" class="pull-left">{{ $rowsp['tensp'] }}</a>
										</td>
										<td class="text-center">
											<span class="amount">
												@if($rowsp['gia_km'] > 0)
													{{ number_format($rowsp['gia_km']) }}₫
												@else
													{{ number_format($rowsp['gia']) }}₫
												@endif
											</span>
										</td>
										<td class="text-center">
											<div class="soluong-sp">
												<a href="/gcart/{{ $rowsp['idsp'] }}"><i class="fas fa-minus"></i></a>
												<input type="text" class="sl" value="{{ $rowsp['soluong'] }}" disabled>
												<a href="/tcart/{{ $rowsp['idsp'] }}"><i class="fas fa-plus"></i></a>
											</div>
										</td>
										<td class="text-center">
											<span class="amount">
												@if($rowsp['gia_km'] > 0)
													{{ number_format($rowsp['gia_km'] * $rowsp['soluong']) }}₫
												@else
													{{ number_format($rowsp['gia'] * $rowsp['soluong']) }}₫
												@endif
											</span>
										</td>
										<td class="text-center">
											<a class="remove" title="Xóa" onclick="return confirm('Bạn có chắc muốn xoá ?')" href="/xcart/{{ $rowsp['idsp'] }}"><i class="fas fa-trash-alt"></i></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="button-order">
						<a href="/dathang"><button type="button" class="button btn-cart add_to_cart_detail detail-button">Đặt hàng</button></a>
					</div>
				</div>
			</form>
		</div>
	</section>
@else
	<section id="main">
		<div class="cart-info">
			Chưa có sản phẩm nào trong giỏ hàng !
			<div class="button-order">
				<a href="/"><button type="button" class="button btn-cart add_to_cart_detail detail-button">Về trang chủ</button></a>
			</div>
		</div>
	</section>
@endif
@endsection
