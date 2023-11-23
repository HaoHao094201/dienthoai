@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Nhập hàng</h2>
            </div>
            <div class="card-body" style="font-weight: 600;">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" name="tensp" class="form-control" value="{{ $sanpham->tensp }}" disabled>
                    </div>
                    <div class="form-group" >
                        <label for="">Loại sản phẩm </label>
                        <select class="form-control" name="loai_sp" disabled>
                            <option>{{ $hangdt->tenloai }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tổng số lượng</label>
                        <input type="number" name="soluong" class="form-control" value="{{ $sanpham->soluong }}" min="0" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng đã bán</label>
                        <input type="number" name="soluong_ban" class="form-control" value="{{ $sanpham->soluong_ban }}" min="0" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng còn lại</label>
                        <input type="number" name="soluong" class="form-control" value="{{ $sanpham->soluong-$sanpham->soluong_ban }}" min="0" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng nhập thêm</label>
                        <input type="number" name="soluong" class="form-control" required value="1" min="1">
                    </div>
                    <button name="sbm" class="btn btn-success" type="submit">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection