@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card border shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Sản phẩm
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($sanpham) }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-mobile fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Đơn hàng
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($donhang) }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-shopping-cart fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Doanh thu
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <?php $tong = 0; ?>
                                            @foreach ($tt as $row)
                                                <?php $tong += $row->tongtien; ?>
                                            @endforeach
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ number_format($tong) }} VNĐ</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Liên hệ
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($lienhe) }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-envelope fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
