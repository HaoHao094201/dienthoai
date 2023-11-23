@extends('home.layout')
@section('content')
	@if(Session::has('mess'))
		<script>alert("{{ Session::get('mess') }}"); </script>
	@endif
	<section id="main">
		<div class="container" style="padding: 0 150px;">
			<div class="breadcrumbs">
				<ul>
					<li class="home"><a href="/" title="Go to Home Page">Trang chủ</a> / </li>
					<li class="category3">Liên hệ</li>
				</ul>
			</div>
			<form accept-charset="UTF-8" action="" id="contact" method="post"> 
				@csrf
				<div class="lh-index">
					<div class="name-all">
						<h1>Liên hệ với chúng tôi</h1>
					</div>	
					<div class="form-comment">
						@if(Session::has('taikhoan'))
							<div class="checkout-content" style="display: flex;justify-content: space-between;">
								<div class="body-3">
									<div class="form-group">
										<label for="name"><em>Họ tên</em><span class="required"> *</span></label>
										<input name="ten" type="text"  class="form-control"  value="{{ Session::get('taikhoan')->tenkh }}"readonly>
									</div>
								</div>
								<div class="body-3">
									<div class="form-group">
										<label for="phone"><em>Số điện thoại</em><span class="required"> *</span></label>
										<input name="sdt" type="text" class="form-control" value="{{ Session::get('taikhoan')->sdt }}"readonly>
									</div>
								</div>
								<div class="body-3">
									<div class="form-group">
										<label for="email"><em>Email</em><span class="required"> *</span></label>
										<input name="email" class="form-control" value="{{ Session::get('taikhoan')->email }}"readonly>
									</div>
								</div>
							</div>
						@else
							<div class="checkout-content" style="display: flex;justify-content: space-between;">
								<div class="body-3">
									<div class="form-group">
										<label for="name"><em>Họ tên</em><span class="required"> *</span></label>
										<input name="ten" type="text"  class="form-control" required>
									</div>
								</div>
								<div class="body-3">
									<div class="form-group">
										<label for="phone"><em>Số điện thoại</em><span class="required"> *</span></label>
										<input type="text" class="form-control" name="sdt" required>
									</div>
								</div>
								<div class="body-3">
									<div class="form-group">
										<label for="email"><em>Email</em><span class="required"> *</span></label>
										<input name="email" class="form-control" type="email" required>
									</div>
								</div>
							</div>
						@endif
						<div class="checkout-content">
							<div class="form-group">
								<label for="message"><em>Tiêu đề</em><span class="required"> *</span></label>
								<input name="tieude" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="message"><em>Nội dung</em><span class="required"> *</span></label>
								<textarea name="noidung" class="form-control" style="resize: none;height: 85px;" required></textarea>
							</div>
						</div>
					</div>
					<div class="button-order">
						<button type="submit" name="sbm" onclick="return confirm('Xác nhận gửi ?')" class="button btn-cart add_to_cart_detail detail-button">Gửi</button>
					</div>
				</div>
			</form>
		</div>
	</section>
@endsection
