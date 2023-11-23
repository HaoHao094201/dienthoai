@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Thêm mã giảm giá</h2>
            </div>
            <div class="card-body" style="font-weight: 600;">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                <div class="col-md-6" style="float: left;">
                    <div class="form-group">
                        <label for="">Mã giảm giá</label>
                        <input type="text" name="magg" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Số tiền giảm</label>
                        <input type="number" name="sotien" class="form-control" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="">Áp dụng đơn hàng tối thiểu</label>
                        <input type="number" name="toithieu" class="form-control" min="0" required>
                    </div>
                </div>
                <div class="col-md-6" style="float: left;">
                    <div class="form-group">
                        <label for="">Giới hạn số lần nhập</label>
                        <input type="number" name="gioihan_luot" class="form-control" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="">Hạn nhập</label>
                        <input type="date" name="ngay_hethan" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-12" style="float: left;">
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea type="text" name="mota" class="form-control" style="resize: none;" required></textarea>
                    </div>
                </div>
                <button name="sbm" class="btn btn-success" style="float: left;" type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </div>
@endsection