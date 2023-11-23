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
        @if(Session::has('errdmk') != null)
        <script>
            $(document).ready(function(){
            $('#myModal2').modal(); 
            });
        </script>
        @endif
        @if(Session::has('mess'))
			<script>alert("{{ Session::get('mess') }}"); </script>
		@endif
        <section id="main">
            <div class="container account">
                <div class="breadcrumbs">
                    <ul>
                        <li class="home"><a href="/" title="Go to Home Page">Trang chủ</a> / </li>
                        <li class="category3">Tài khoản của tôi</li>
                    </ul>
                </div>
                <div class="col-right col-md-4 col-xs-12">
                    <div class="block block-account acc">
                        <div class="user2">
                            <div class="infor-user2"><span>{{ substr($khachhang->tenkh,0,1)}}</span></div>
                            <div class="user2-detail">
                                <h1 style="font-weight: 600;font-size: 22px;">{{ $khachhang->tenkh }}</h1>
                                <h1>{{ $khachhang->sdt }}</h1>
                                <h1>{{ $khachhang->email }}</h1>
                                <div class="btn-up" style="margin-top:5px;">
                                    <a href="#"><button class="btn" data-toggle="modal" data-target="#myModal2">Cập nhật mật khẩu</button></a>
                                    <a href="/dangxuat" onclick="return confirm('Bạn có chắc muốn thoát ?')"><button class="btn">Thoát</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="myModal2">
                            <div class="modal-dialog" style="width:500px;">
                                <div class="modal-content" style="border-radius: 6px;">
                                    <div class="modal-login">
                                        <h1>Cập nhật mật khẩu</h1>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="/doimk/{{ $khachhang->idkh }}" method="post">@csrf
                                        <div class="modal-body">
                                            <div class="col_full">
                                                <input type="password" name="matkhau_c" placeholder="Nhập mật khẩu hiện tại" class="form-control form-input">
                                                @isset(Session::get('errdmk')['matkhau_c'])
                                                    <p style="color: #ff0000;font-style: italic;font-size: 0.9em;">{{ Session::get('errdmk')['matkhau_c'] }}</p>
                                                @endisset
                                            </div>
                                            <div class="col_full">
                                                <input type="password" name="matkhau_m" placeholder="Nhập mật khẩu mới" class="form-control form-input" >
                                                @isset(Session::get('errdmk')['matkhau_m'])
                                                    <p style="color: #ff0000;font-style: italic;font-size: 0.9em;">{{ Session::get('errdmk')['matkhau_m'] }}</p>
                                                @endisset
                                            </div>
                                            <div class="col_full">
                                                <input type="password" name="re_matkhau_m" placeholder="Nhập lại mật khẩu mới" class="form-control form-input" >
                                                @isset(Session::get('errdmk')['re_matkhau_m'])
                                                    <p style="color: #ff0000;font-style: italic;font-size: 0.9em;">{{ Session::get('errdmk')['re_matkhau_m'] }}</p>
                                                @endisset
                                            </div>
                                        </div>
                                        <div class="button-order" style="padding: 0 20px 20px 20px;;margin: 0;">
                                            <button type="submit" name="up" class="button btn-cart add_to_cart_detail detail-button">Xác nhận</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-main col-md-8 col-sm-12 ds-order">
                    <div class="my-account">
                        <div class="name-all">
                            <h1>Danh sách đơn hàng</h1>
                        </div>
                        @if(count($donhang) > 0)
                            <div class="table-responsive" style="padding: 15px;">
                                <table class="table table-hover " style="border: 1px solid #dcdcdc;margin: 0;">
                                    <thead>
                                        <tr style="background: #f3f3f3;">
                                            <th>Đơn hàng</th>
                                            <th>Ngày</th>
                                            <th>Giá trị đơn hàng</th>
                                            <th class="text-center">Trạng thái đơn hàng</th>
                                            <th class="text-center" colspan="2"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($donhang as $dh)
                                            <tr>
                                                <td>#{{ $dh->madh }}</td>
                                                <td>{{ $dh->ngay_dat }}</td>
                                                <td>{{ number_format($dh->tongtien) }}₫</td>
                                                <td class="text-center">
                                                    @switch ($dh->trangthai)
                                                        @case ('0')
                                                            Chờ thanh toán
                                                            @break
                                                        @case ('1')
                                                            Đang chờ duyệt
                                                            @break
                                                        @case ('2')
                                                            Đang giao hàng
                                                            @break
                                                        @case ('3')
                                                            Đã nhận hàng
                                                            @break
                                                        @case ('4')
                                                            Nhân viên đã hủy
                                                            @break
                                                        @case ('5')
                                                            Bạn đã hủy
                                                            @break
                                                    @endswitch
                                                </td>
                                                <td class="text-center">
                                                    <span> <a style="color: #0f9ed8;" href="/chitietdh/{{ $dh->iddh }}">Xem chi tiết</a></span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="page">  
                                @include('page.page')
                            </div>
                        @else
                            <div class="cart-info">Không có đơn hàng nào !</div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
