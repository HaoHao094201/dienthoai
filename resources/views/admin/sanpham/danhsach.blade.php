@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Danh sách sản phẩm </h2>
                <a class="btn btn-primary" style="position: absolute; right: 5px; top: 17px" href="/admin/them-sanpham">Thêm mới</a>
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
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng trong kho</th>
                            <th class="text-center">Nhập hàng</th>
                            <th class="text-center" colspan="2">Hoạt động</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                            @foreach($sanpham as $sp) 
                                <tr>
                                    <td class="text-center">{{$i++}}</td>
                                    <td><img style="width: 70px" src="{{asset('storage/img/sanpham/'.$sp->img)}}"></td>
                                    <td>{{$sp->tensp}}</td>
                                    <td>{{$sp->tenloai}}</td>
                                    <td>{{number_format($sp->gia)}}₫</td>
                                    <td class="text-center">{{$sp->soluong-$sp->soluong_ban}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="/admin/nhaphang/{{$sp->idsp}}">Nhập</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-success" href="/admin/sua-sanpham/{{$sp->idsp}}">Sửa</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-xs" onclick="return Del('{{$sp->tensp}}')" href="/admin/xoa-sanpham/{{$sp->idsp}}">Xóa</a>
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
<script>
    function Del(name)
    {
        return confirm("Bạn có chắc chắn muốn xóa: "+name+" ?");
    }
</script>