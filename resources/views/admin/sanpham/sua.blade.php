@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Sửa sản phẩm</h2>
            </div>
            <div class="card-body" style="font-weight: 600;">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                <div class="col-md-6" style="float: left;">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" name="tensp" class="form-control" required value="{{ $sanpham->tensp }}">
                    </div>
                    <div class="form-group">
                        <label for="">Giá</label>
                        <input type="number" name="gia" class="form-control" required value="{{ $sanpham->gia }}" min="0">
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="number" name="soluong" class="form-control" required value="{{ $sanpham->soluong }}" min="{{ $sanpham->soluong_ban }}">
                    </div>
                </div>
                <div class="col-md-6" style="float: left;">
                    <div class="form-group">
                        <label for="">Loại sản phẩm </label>
                        <select class="form-control" name="loai_sp" required>
                            <option value = "">--- Chọn loại sản phẩm ---</option>
                            @foreach ($hangdt as $hdt)
                                <option value="{{ $hdt->idhdt }}">{{ $hdt->tenloai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Giá khuyến mãi</label>
                        <input type="number" name="gia_km" class="form-control" required value="{{ $sanpham->gia_km }}" min="0">
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh</label> <br>
                        <input type="file" name="img">
                    </div>
                </div>
                <div class="col-md-12" style="float: left;">
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea type="text" name="mota" class="form-control" style="height: 200px;resize: none;" required >{{ $sanpham->mota }}</textarea>
                    </div>
                </div>
                <button name="sbm" class="btn btn-success" style="float: left;" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </div>
@endsection

