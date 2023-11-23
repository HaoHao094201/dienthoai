<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Hao Hao</title>
    <link href="{{asset('storage/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('storage/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('storage/css/lte.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="{{asset('storage/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('storage/css/AdminLTE.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('storage/css/style-jc.css')}}">
    <link href="{{asset('storage/css/menu-tab.css')}}" rel="stylesheet">
    <link href="{{asset('storage/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('storage/css/jquery.bxslider.css')}}" rel="stylesheet">
    <link href="{{asset('storage/css/flexslider.css')}}" rel="stylesheet">
    <link href="{{asset('storage/css/home.css')}}" rel="stylesheet">
    <script src="{{asset('storage/js/jquery-2.2.3.min.js')}}"></script>
</head>
@if(Session::has('errdn'))
    <script>
        $(document).ready(function(){
        $('#myModal').modal(); 
        });
    </script>
@endif
@if(Session::has('errdk'))
    <script>
        $(document).ready(function(){
        $('#myModal1').modal(); 
        });
    </script>
@endif
@if(Session::has('tb'))
    <script>alert("{{ Session::get('tb') }}"); </script>
@endif
<body>
    <div class="timkiem" style="background-color: #f8f9fa;">
        <div class="container" style="display: flex;">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 logo"></div>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 search">
                <form action="/timkiem" method="get" role="form">
                    <div class="input-search">
                        <input type="text" class="form-control" id="search_text" name="timkiem" placeholder="Nhập từ khóa để tìm kiếm...">
                        <button><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1" style="padding: 10px; margin: 0 20px 0 20px;">
                <div class="shop-cart">
                    <a href="/giohang">
                        <i class="fa fa-shopping-cart">
                            @if(Session::get('giohang') != null)
                                <p>({{ count(Session::get('giohang')) }})</p>
                            @endif
                        </i>
                        <div class="box_text"><span style="font-weight: 600;">Giỏ hàng</span></div>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2" style="padding: 10px;">
                <div class="user">
                    @if(Session::has('taikhoan'))
                        <a href="/ttkh/{{ Session::get('taikhoan')['idkh'] }}">
                            <i class="fas fa-user-circle"></i>
                            <div class="box_text"><span style="font-weight: 600;">{{ Session::get('taikhoan')['tenkh'] }}</span></div>
                        </a>
                    @else
                        <li>
                            <a href="#">
                                <i class="fas fa-user-circle"></i>
                                <div class="box_text"><span style="font-weight: 600;">Tài khoản</span></div>
                            </a>
                            <ul>
                                <a href="#" class="user-modal" data-toggle="modal" data-target="#myModal">
                                    <div class="box_text"><span>Đăng nhập</span></div>
                                </a>
                                <a href="#" class="user-modal1" data-toggle="modal" data-target="#myModal1">
                                    <div class="box_text"><span>Đăng ký</span></div>
                                </a>
                            </ul>
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog" style="width:500px;">
                                    <div class="modal-content" style="border-radius: 6px;">
                                        <div class="modal-login">
                                            <h1>Đăng nhập</h1>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form action="/dangnhap" method="post"> @csrf
                                            <div class="modal-body">
                                                <div class="col_full">
                                                    <input type="email" name="email" placeholder="Nhập email" class="form-control form-input" required>
                                                </div>
                                                <div class="col_full">
                                                    <input type="password" name="matkhau" placeholder="Nhập mật khẩu" class="form-control form-input" required>
                                                </div>
                                                @if(Session::has('errdn'))
                                                    <p style="color: #ff0000;font-style: italic;font-size: 0.9em;">{{ Session::get('errdn') }}</p>
                                                @endif
                                            </div>
                                            <div class="button-order" style="padding: 0 20px 20px 20px;;margin: 0;">
                                                <button type="submit" name="dangnhap" class="button btn-cart add_to_cart_detail detail-button">Đăng nhập</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="myModal1">
                                <div class="modal-dialog" style="width:500px;">
                                    <div class="modal-content" style="border-radius: 6px;">
                                        <div class="modal-login">
                                            <h1>Đăng ký tài khoản</h1>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form action="/dangky" method="post"> @csrf
                                            <div class="modal-body">
                                                <div class="col_full">
                                                    <input type="email" name="email" class="form-control form-input" placeholder="Nhập email">
                                                    @isset(Session::get('errdk')['email'])
                                                        <p style="color: #ff0000;font-style: italic;font-size: 0.9em;">{{ Session::get('errdk')['email'] }}</p>
                                                    @endisset
                                                </div> 
                                                <div class="col_full">
                                                    <input type="password" name="matkhau" placeholder="Mật khẩu" class="form-control form-input">
                                                    @isset(Session::get('errdk')['matkhau'])
                                                        <p style="color: #ff0000;font-style: italic;font-size: 0.9em;">{{ Session::get('errdk')['matkhau'] }}</p>
                                                    @endisset
                                                </div>
                                                <div class="col_full">
                                                    <input type="password" name="re_matkhau" value="" class="form-control form-input" placeholder="Nhập lại mật khẩu">
                                                    @isset(Session::get('errdk')['re_matkhau'])
                                                        <p style="color: #ff0000;font-style: italic;font-size: 0.9em;">{{ Session::get('errdk')['re_matkhau'] }}</p>
                                                    @endisset
                                                </div>
                                                <div class="col_full">
                                                    <input type="text" name="tenkh" placeholder="Họ tên" class="form-control form-input">
                                                    @isset(Session::get('errdk')['tenkh'])
                                                        <p style="color: #ff0000;font-style: italic;font-size: 0.9em;">{{ Session::get('errdk')['tenkh'] }}</p>
                                                    @endisset
                                                </div>    
                                                <div class="col_full">
                                                    <input type="text" name="sdt" placeholder="Số điện thoại" class="form-control form-input">
                                                    @isset(Session::get('errdk')['sdt'])
                                                        <p style="color: #ff0000;font-style: italic;font-size: 0.9em;">{{ Session::get('errdk')['sdt'] }}</p>
                                                    @endisset
                                                </div>   
                                            </div>
                                            <div class="button-order" style="padding: 0 20px 20px 20px;;margin: 0;">
                                                <button type="submit" name="dangky" class="button btn-cart add_to_cart_detail detail-button">Đăng ký</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                </div>
            </div>
        </div> 
    </div> 
    <section id="menu-slider">
        <div class="menu-pri">
            <div class="container">
                <div class="col-md-12 col-lg-12 panel-right text-center">
                    <ul class="menu-right" style="display: inline-block;">
                        <li class="pull-left"><a href="/">TRANG CHỦ</a></li>
                        <li class="pull-left"><a href="/sanpham">SẢN PHẨM</a></li>
                        <li class="pull-left"><a href="/lienhe">LIÊN HỆ</a></li>
                        <li class="pull-left"><a href="">GIỚI THIỆU</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @yield('content') 
    <footer id="footer">
        <div class="top-footer">
            <div class="container" style="padding: 0 100px;">
                <div class="col-md-3">
                    <ul class="list-unstyled linklists">
                        <li><a href="#">Giới thiệu về công ty</a></li>          
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Quy chế hoạt động</a></li>
                        <li><a href="#">Kiểm tra hóa đơn điện tử</a></li>   
                        <li><a href="#">Tra cứu thông tin bảo hành</a></li>   
                        <li><a href="#">Câu hỏi thường gặp mua hàng</a></li>                      
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="list-unstyled linklists">
                        <li><a href="#">Tin tuyển dụng</a></li>          
                        <li><a href="#">Tin khuyến mãi</a></li>
                        <li><a href="#">Hướng dẫn mua online</a></li>  
                        <li><a href="#">Hướng dẫn mua trả góp</a></li>
                        <li><a href="#">Chính sách trả góp</a></li>                  
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="list-unstyled linklists">
                        <li><a href="#">Hệ thống cửa hàng</a></li>          
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Hệ thống bảo hành</a></li>     
                        <li><a href="#">Giới thiệu máy đổi trả</a></li>                
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="list-unstyled linklists">
                        <li><span>Tư vấn mua hàng (Miễn phí)</span><p>1800 2001</p></li>          
                        <li><span>Hỗ trợ kỹ thuật</span><p>1800 2001</p></li>
                        <li><span>Góp ý, khiếu nại (8h00 - 22h00)</span><p>1800 0904</p></li>                   
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <span>Điện thoại: (036) 7551 876. Email: phandoanhao2k1@gmail.com. Chịu trách nhiệm nội dung: Hao Hao.</span>
        </div>
    </footer>
    <script src="{{asset('storage/js/bootstrap.js')}}"></script>
    <script src="{{asset('storage/js/app.min.js')}}"></script>
    <script src="{{asset('storage/js/owl.carousel.js')}}"></script>
    <script src="{{asset('storage/js/jquery.jcarousel.js')}}"></script>
    <script src="{{asset('storage/js/jcarousel.connected-carousels.js')}}"></script>
    <script src="{{asset('storage/js/scroll.js')}}"></script>
    <script src="{{asset('storage/js/search-quick.js')}}"></script>
    <script src="{{asset('storage/js/custom-owl.js')}}"></script>
    <script src="{{asset('storage/js/jquery.flexslider.js')}}"></script>      
</body>
</html>