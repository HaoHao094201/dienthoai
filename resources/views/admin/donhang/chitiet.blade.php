@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body" style="font-size:20px;">
                <h1 class="text-center" style="color: red;">CHI TIẾT ĐƠN HÀNG</h1>
                <p>Mã đơn hàng: <b>#{{ $donhang->madh }}</b></p>
                <p>Tên khách hàng: <b>{{ $khachhang->tenkh }}</b></p>
                <p>Điện thoại: <i>{{ $khachhang->sdt }}</i></p>
                <p>Thời gian đặt hàng: <i>{{ $donhang->ngay_dat }}</i></p>
                <p>Địa chỉ: {{ $donhang->diachi }}, {{ $huyen->ten_h }}, {{ $tinh->ten_t }}</p>
            </div> 
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá bán</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; $tongtien = 0; ?>
                            @foreach ($ctdh as $row)
                                @if($row->gia_km > 0)
                                    <?php $gia = $row->gia_km * $row->soluong_m ?>
                                @else
                                    <?php $gia = $row->gia * $row->soluong_m ?>
                                @endif
                                <?php $tongtien += $gia; ?>
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td>{{ $row->tensp }}</td>
                                    <td>{{ $row->soluong_m }}</td>
                                    <td>
                                        @if($row->gia_km > 0)
                                            {{ number_format($row->gia_km) }}₫
                                        @else
                                            {{ number_format($row->gia) }}₫
                                        @endif
                                    </td>
                                    <td>{{ number_format($gia) }}₫</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" class="text-right" style="border: none; font-size: 1.1em;">Tổng cộng: {{ number_format($tongtien) }}₫</td>
                            </tr>
                            @if($giamgia != 0)
                                <tr>
                                    <td colspan="6" class="text-right" style="border: none; font-size: 1.1em;">Voucher giảm giá :{{ number_format($giamgia) }}₫</td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="6" class="text-right" style="border: none; font-size: 0.9em;"><i>Phí vận chuyển: </i>
                                    {{ number_format($gia_ship) }}₫
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-right" style="border: none; color: red; font-size: 1.3em;">Thành tiền: {{ number_format($tongtien-$giamgia+$gia_ship) }}₫</td>
                            </tr>
                        </tbody>
                    </table>
                </div>   
            </div>
        </div>
    </div>
@endsection