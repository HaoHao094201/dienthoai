@extends('home.layout')
@section('content')
	<section id="main">
		<div class="container">
			<div class="breadcrumbs">
				<ul>
					<li class="home"><a href="/" title="Go to Home Page">Trang chủ</a> / </li>
					<li class="category3">{{ $hangdt->tenloai }}</li>
				</ul>
			</div>
			<div class="products-wrap">
				<form action="/cart/{{ $sanpham->idsp }}" method="post" id="ProductDetailsForm">@csrf
					<div class="product-view-content">
						<div class="product-view-name">
							<h1>{{ $sanpham->tensp }}</h1>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 listimg-desc-product">
						<div class="flexslider">
							<div class="slides">
								<div class="thumb-image" style="display: flex; justify-content: center;">
									<img style="width:93%;" src="{{asset('storage/img/sanpham/'.$sanpham->img)}}" class="img-responsive">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="product-view-content">
							<div class="product-view-price">
								@if($sanpham->gia_km > 0)
									<div class="pull-left">
										<span class="price-label">Giá bán:</span>
										<span class="price">{{  number_format($sanpham->gia_km) }}₫</span>
									</div>
									<div class="product-view-price-old">
										<span class="price">{{  number_format($sanpham->gia) }}₫</span>
									</div>
								@else
									<div class="pull-left">
										<span class="price-label">Giá bán:</span>
										<span class="price">{{  number_format($sanpham->gia) }}₫</span>
									</div>
								@endif
							</div>
							<div class="product-status">
								<p style=" float: left;margin-right: 10px;">Thương hiệu: {{ $hangdt->tenloai }}</p>
								<p>| Tình trạng: @if($sanpham->soluong - $sanpham->soluong_ban==0) Hết hàng @else Còn hàng @endif </p>
							</div>
							<div class="actions-qty">
								@if($sanpham->soluong - $sanpham->soluong_ban == 0 )
									<h2 style="color:red;">Ngừng kinh doanh</h2>
								@else
									<div class="actions-qty__button">
										<button name="sbm" type="submit" class="button btn-cart add_to_cart_detail detail-button" onclick="alert('Đã thêm sản phẩm vào giỏ hàng !')">Mua ngay</button>
									</div>
								@endif
							</div>
							<div class="ts-detail">
								<div class="ts"><a>Thông số kỹ thuật</a></div>
								<div class="ts-box">
									<div class="col-lg-3">
										<span>Màn hình:</span>
										<span>Camera sau:</span>
										<span>Camera Selfie:</span>
										<span>RAM:</span>
										<span>Bộ nhớ trong:</span>
										<span>CPU:</span>
										<span>GPU:</span>
										<span>Dung lượng pin:</span>
										<span>Thẻ sim:</span>
										<span>Hệ điều hành:</span>
									</div>
									<textarea class="col-lg-9" disabled>{{ $sanpham->mota }}</textarea>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="product-comment product-v-desc">
				<div class="name-all" style="margin-bottom: 20px;"><h1>Đánh giá sản phẩm</h1></div>
				<div class="tab-content" style="padding-left: 15px; padding-right: 10px;">
					<div class="binhluan">
						@if(count($binhluan) > 0)
							@foreach ($binhluan as $bl)
								<div class="khung">
									<div class="user1">												
										<div class="infor-user"><span>{{ substr($bl->tenkh,0,1) }}</span></div>												
										<div class="coment-user">
											<h4>{{ $bl->tenkh }}</h4>
											<p>{{ $bl->binhluan }}</p>
											<div class="date">
												<a style="color: #939ca3;">{{ $bl->ngay }}</a>
												<i class="fa fa-circle" style="font-size: 5px;"></i>
												<div class="like">Thích</div>
											</div>
										</div>
									</div>	
									@if(Session:: has('taikhoan') != null)
										@if($bl->idkhachhang == Session::get('taikhoan')->idkh)
											<a title="Xóa" onclick="return confirm('Bạn có chắc muốn xoá đánh giá này ?')" href="/xoabl/{{ $bl->idbl }}"><i class="fas fa-times"></i></a>
										@endif
									@endif
								</div>
								<hr>
							@endforeach
						@else
							<div class="cart-info">Chưa có đánh giá nào !</div>
							<hr>
						@endif																
					</div>
					<form action="/binhluan/{{ $sanpham->idsp }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<textarea type="text" name="binhluan" placeholder="Đánh giá sản phẩm" required></textarea>
							<button class="btn btn-danger btn-xs" type="submit" name="bl" value="Đánh giá" style="background-color: #cb1c22;" >Gửi bình luận</button>
						</div>
					<form>
				</div>
				<div class="page">  
					@include('page.page')
				</div>	
			</div>
			<div class="product-comment product-v-desc">
				<div class="name-all">
					<h1 style="padding-left:15px;">Sản phẩm liên quan</h1>
				</div>
				<div class="owl-carousel owl-carousel-product owl-theme">
					@foreach ($sld_sp as $sld)
						<div class="item" style="margin: 0px;">
							<div class="product" style="height: 330px;">
								<a class="img" href="/chitietsp/{{ $sld->idsp }}" title="{{ $sld->tensp }}" >
									<img class="img-1" style="width:200px;height:200px;" src="{{asset('storage/img/sanpham/'.$sld->img)}}" alt="">
								</a>
								<div class="lt-product-group-info">
									<h3 class="name">
										<a href="/chitietsp/{{ $sld->idsp }}" title="{{ $sld->tensp }}">{{ $sld->tensp }}</a>
									</h3>
								</div>
								<div class="price-box">
									@if($sld->gia_km > 0)
										<p class="special-price">
											<span class="price" style="color: #fff;">{{ number_format($sld->gia_km) }}₫</span>
										</p>
										<p class="old-price">
											<span class="price">{{ number_format($sld->gia) }}₫</span>
										</p>
									@else
										<p class="special-price">
											<span class="price" style="color: #fff;">{{ number_format($sld->gia) }}₫</span>
										</p>
									@endif
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
@endsection
