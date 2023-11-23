@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Sửa loại sản phẩm</h2>
            </div>
            <div class="card-body" style="font-weight: 600;">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                    <label for="">Tên loại san phẩm</label>
                    <input type="text" name="tenloai" class="form-control" value="{{ $hangdt->tenloai }}" required >
                </div>
                <button name="sbm" class="btn btn-success" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </div>
@endsection