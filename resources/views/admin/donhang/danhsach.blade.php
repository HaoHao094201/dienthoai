@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Danh sách đơn hàng</h2>
            </div>
            @if(Session::has('mess'))
                <div class="alert alert-success" style="margin: 10px;">
                    {{ Session::get('mess') }}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger" style="margin: 10px;">
                    {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>
		    @endif
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Điện thoại</th>
                            <th>Tổng tiền</th>
                            <th>Ngày tạo</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center" colspan="2">Xử lý</th>
                            <th class="text-center">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                            @foreach ($donhang as $dh)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td>#{{ $dh->madh }}</td>
                                    <td>{{ $dh->tenkh }}</td>
                                    <td>{{ $dh->sdt }}</td>
                                    <td>{{ number_format($dh->tongtien) }}₫</td>
                                    <td>{{ $dh->ngay_dat }}</td>
                                    <td style="text-align: center;">
                                        @switch ($dh->trangthai) 
                                            @case ('0') 
                                                Chờ thanh toán
                                                @break
                                            @case ('1')
                                                Đã thanh toán
                                                @break
                                            @case ('2')
                                                Đang giao hàng
                                                @break
                                            @case ('3')
                                                Đã nhận hàng
                                                @break
                                            @case ('4')
                                                Đã hủy
                                                @break
                                            @case ('5')
                                                Khách hàng đã hủy
                                                @break
                                        @endswitch
                                    </td>
                                    <td class="text-center">
                                        @if($dh->trangthai==1)
                                            <a class="btn btn-primary" href="/admin/trangthai-donhang/{{ $dh->iddh }}">Duyệt đơn đặt hàng </a>
                                        @elseif($dh->trangthai==2)
                                            <a class="btn btn-success btn-xs" href="/admin/trangthai-donhang/{{ $dh->iddh }}">Xác nhận đã giao hàng</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($dh->trangthai ==0 || $dh->trangthai ==1)
                                            <a class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn huỷ đơn hàng #{{ $dh->madh }}?');" href="/admin/huy-donhang/{{ $dh->iddh }}">Hủy đơn</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="/admin/chitiet-donhang/{{ $dh->iddh }}">Xem</a>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                <div class="page">  
                    @include('page.page')
                </div>
            </div>
        </div>
    </div>
@endsection
