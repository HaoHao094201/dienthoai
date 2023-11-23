<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hao Hao</title>
    <link href="{{asset('storage/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="{{asset('storage/assets/css/style.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('storage/assets/css/sb-admin-2.min.css')}}" />
    <link href="{{asset('torage/assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="{{asset('storage/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('storage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('storage/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('storage/assets/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('storage/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('storage/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('storage/assets/js/datatables-demo.js')}}"></script>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-info text-white sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000!important; ">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" style="background-color: #cd1818!important;" href="/admin">Hệ thống quản lý</a>
           
            <li class="nav-item">
                <a class="nav-link" href="/admin/sanpham">
                    <i class="fa fa-mobile"></i>
                    <span>Sản phẩm</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/hangdt">
                    <i class="fa fa-mobile"></i>
                    <span>Loại sản phẩm</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/donhang">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Đơn hàng</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/giamgia">
                    <i class="fa fa-mobile"></i>
                    <span>Mã giảm giá</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/khachhang">
                    <i class="fa fa-user"></i>
                    <span>Khách hàng</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/binhluan">
                    <i class="fa fa-comments"></i>
                    <span>Bình luận</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/lienhe">
                    <i class="fa fa-envelope"></i>
                    <span>Liên hệ</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/slider">
                    <i class="fa fa-file-image"></i>
                    <span>Slider</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/logout" onclick="return confirm('Bạn có chắc muốn thoát ?')">
                <i class="fas fa-power-off"></i>
                    <span>Đăng xuất</span>
                </a>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"></nav>
@yield('content')           
</body>
<style>
    .sidebar .nav-item .nav-link span {
        font-size: 16px;
        display: inline;
        font-family: "Roboto", sans-serif;
    }
    .sidebar .nav-item .nav-link {
        color: #fff;
        font-weight: 700;
    }
    .sidebar .nav-item .nav-link i {
        color: #fff;
        font-size: 16px;
        width: 20px;
        text-align: center;
    }
    .sidebar-dark .nav-item .nav-link:hover {
        color: #aaa;
    }
    .sidebar-dark .nav-item .nav-link:hover i {
        color: #aaa;
    }
    .sidebar-dark a:hover {
        color: #aaa;
    }
    .text-xs{
        font-size: 20px;
    }
    .page{
        justify-content: center ;
        display: flex;
        margin: 20px;
    }
    .page-item{
        margin: 0 3px;
        width: 36px;
        color: #444b52;
        background: #fff;
        height: 36px;
        font-size: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        padding: 0;
        border-radius: 4px;
        border: 1px solid #cbd1d6;
    }
    .numss{
        background: #cb1c22;
        color: #fff;
        border-color: #cb1c22;
    }
    .page a:hover{
        background: #cb1c22;
        color: #fff;
        border-color: #cb1c22;
        text-decoration: none;
    }
    .page i{
        font-size: 20px;
    }
</style>