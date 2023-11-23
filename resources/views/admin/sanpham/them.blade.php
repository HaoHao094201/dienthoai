@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Thêm sản phẩm</h2>
            </div>
            <div class="card-body" style="font-weight: 600;">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                <div class="col-md-6" style="float: left;">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" name="tensp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Giá</label>
                        <input type="number" name="gia" class="form-control" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="number" name="soluong" class="form-control" min="1" required>
                    </div>
                </div>
                <div class="col-md-6" style="float: left;">
                    <div class="form-group">
                        <label for="">Loại sản phẩm</label>
                        <select class="form-control" name="loai_sp" required>
                            <option value = "">--- Chọn loại sản phẩm ---</option>
                            @foreach ($hangdt as $hdt)
                                <option value="{{ $hdt->idhdt }}">{{ $hdt->tenloai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Giá khuyến mãi</label>
                        <input type="number" name="gia_km" class="form-control" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh</label> <br>
                        <input type="file" name="img" >
                    </div>
                </div>
                <div class="col-md-12" style="float: left;">
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea type="text" name="mota" class="form-control" style="height: 200px;resize: none;" required></textarea>
                    </div>
                </div>
                <button name="sbm" class="btn btn-success" style="float: left;" type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </div>
@endsection