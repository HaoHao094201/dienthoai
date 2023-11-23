<title>Hao Hao</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-center text-dark">Đăng Nhập</h3>
                            <div class="form-group">
                                <label for="TaiKhoan" class="text-dark">Tài Khoản:</label><br>
                                <input type="text" name="TaiKhoan" id="TaiKhoan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="MatKhau" class="text-dark">Mật Khẩu:</label><br>
                                <input type="password" name="MatKhau" id="MatKhau" class="form-control" required>
                            </div>
                            @if(Session::has('error') != null)
                                <p style="color: #ff0000;font-style: italic;font-size: 0.9em;">{{ Session::get('error') }}</p>
                            @endif
                            <div class="form-group">
                                <button type="submit" name="submit" class="form-control btn btn-primary btn-login">Đăng Nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
body {
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
    height: 100vh;
}
#login .container #login-row #login-column #login-box {
    margin-top: 120px;
    max-width: 600px;
    background-color: #fff;
    box-shadow: 0px 1px 4px rgba(10, 10, 10, 0.15);
    border-radius: 6px;
}
#login .container #login-row #login-column #login-box #login-form {
    padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
    margin-top: -85px;
}
</style>
