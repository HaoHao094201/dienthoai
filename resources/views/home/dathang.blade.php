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
    <section id="main">
        <div class="container">
            <div class="breadcrumbs">
                <ul>
                    <li class="home"><a href="/" title="Go to Home Page">Trang chủ</a> / </li>
                    <li class="category3">Đặt hàng</li>
                </ul>
            </div>
            <form method="POST" action="" enctype="multipart/form-data"> @csrf
                <div class="checkout-content order col-md-7">
                    <div class="name-all">
                        <h1>Thông tin giao hàng</h1>
                    </div>
                    <div class="card-body">
                        <div class="body-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="tenkh" value="{{ Session::get('taikhoan')['tenkh'] }}"readonly>
                            </div>
                            <div class="form-group">
                                <input type="text"  class="form-control" name="sdt" value="{{ Session::get('taikhoan')['sdt'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" value="{{ Session::get('taikhoan')['email'] }}"readonly>
                            </div>
                            <div class="form-group" style="display: flex; margin: 0;">
                                <input id="coupon" type="text" name="giamgia" class="form-control" placeholder="Mã giảm giá (nếu có)">
                                <a class="btn btn-success" style="font-size: 14px;margin-left: 10px;padding: 6px 12px;" onclick="sdgiamgia()">Check</a>
                            </div>
                            <div class="error" id="giamgia"></div>
                        </div>
                        <div class="body-6">
                            <div class="form-group">
                                <select name="idtinh" id="tinh" onchange="quanhuyen()" class="form-control next-select" required>
                                    <option value="">--- Chọn tỉnh thành ---</option>
                                    @foreach ($tinh as $t)
                                        <option value="{{ $t->idt }}">{{ $t->ten_t }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="idhuyen" id="huyen" class="form-control next-select" required>
                                    <option value="">--- Chọn quận huyện ---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="diachi" placeholder="Địa chỉ nhận hàng" class="form-control" rows="4" style="height: 85px;resize: none;" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="button-order">
                        <button type="submit" name="sbm" class="button btn-cart add_to_cart_detail detail-button">Đặt hàng</button>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="order-detail">
                        <div class="name-all">
                            <h1>Thông tin đơn hàng</h1>
                        </div>
                        <div class="products-detail">
                            <table class="table" style="border: 1px solid #dcdcdc;margin:0;">
                                <tbody>
                                    <tr style="background: #f3f3f3;">
                                        <th style="width: 140px;">Sản phẩm</th>
                                        <th class="text-center" style="width: 90px;">Số lượng</th>
                                        <th class="text-center">Giá</th>
                                        <th class="text-center">Tổng</th>
                                    </tr>
                                        <?php $tongtien = 0; ?>
                                    @foreach(Session::get('giohang') as $rowsp )
                                        @if($rowsp['gia_km'] > 0)
                                            <?php $giatien = $rowsp['gia_km'] * $rowsp['soluong']; ?>
                                        @else
                                            <?php $giatien = $rowsp['gia'] * $rowsp['soluong']; ?>
                                        @endif
                                        <?php $tongtien += $giatien; ?>
                                        <tr>
                                            <td>{{ $rowsp['tensp'];  }}</td>
                                            <td class="text-center">{{ $rowsp['soluong'] }}</td>
                                            <td> 
                                                @if($rowsp['gia_km'] > 0)
                                                    {{ number_format($rowsp['gia_km']) }}₫
                                                @else
                                                    {{ number_format($rowsp['gia']) }}₫
                                                @endif
                                            </td>
                                            <td>{{ number_format($giatien) }}₫</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3">Tổng cộng :</td>
                                        <td>{{ number_format($tongtien) }}₫</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="font-style: italic;">(Phí giao hàng)</td>
                                        <td>{{ number_format($rowsp['gia_ship']) }}₫</td>
                                    </tr>
                                    <tr> 
                                        @if(Session::has('giamgia'))
                                            <td colspan="3">Voucher giảm giá: </td>
                                            <td style="display: flex;justify-content: space-between;">-{{ number_format(Session::get('giamgia')['sotien']) }}₫
                                            <a href="/xmgg"><i class="fas fa-times"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="font-size: 15px; color: red;font-weight: 600;">Thành tiền </td>
                                        <td style="font-size: 15px; color: red;font-weight: 600;">
                                            @if(Session::has('giamgia'))
                                                <?php $tien = $tongtien + $rowsp['gia_ship'] - Session::get('giamgia')['sotien'] ?>
                                            @else
                                                <?php $tien = $tongtien + $rowsp['gia_ship']; ?>
                                            @endif
                                            {{ number_format($tien) }}₫
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @endif
    <script>
        function quanhuyen(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            var idt=$("#tinh").val();
            $.post('/huyen', {idt : idt}, function(data){
                $("#huyen").html(data);
            })
        }
        function sdgiamgia(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            var magg = $("input[name='giamgia']").val();
            $.post('/ktmgg', {magg : magg}, function(data){
                $("#giamgia").html(data);
            })
        }
    </script>
@endsection
