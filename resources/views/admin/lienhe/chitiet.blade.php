@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Chi tiết</h2>
            </div>
            <div class="card-body" style="font-weight: 600;">
                <form method="POST" action="" enctype="multipart/form-data">
                <div class="col-md-6" style="float: left;">
                    <div class="form-group">
                        <label for="">Tên</label>
                        <output type="text" name="ten" class="form-control" >{{ $lienhe->ten }}</output>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày gửi</label>
                        <output type="date" name="ngay" class="form-control" >{{ $lienhe->ngay }}</output>
                    </div>
                    <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <output type="text" name="tieude" class="form-control" >{{ $lienhe->tieude }}</output>
                    </div>
                </div>
                <div class="col-md-6" style="float: left;">
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <output type="text" name="sdt" class="form-control" >{{ $lienhe->sdt }}</output>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <output type="text" name="email" class="form-control" >{{ $lienhe->email }}</output>
                    </div>
                </div>
                <div class="col-md-12" style="float: left;">
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea type="text" name="noidung" class="form-control" style="height: 200px;resize: none;">{{ $lienhe->noidung }}</textarea>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
