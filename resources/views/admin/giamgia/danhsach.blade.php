@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Danh sách mã giảm giá </h2>
                <a class="btn btn-primary" style="position: absolute; right: 5px; top: 17px" href="/admin/them-giamgia">Thêm mới</a>
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
                            <th>Mã giảm giá</th>
                            <th>Số tiền giảm</th>
                            <th>Áp dụng đơn hàng tối thiểu</th>
                            <th>Giới hạn số lần nhập</th>
                            <th>Hạn nhập</th>
                            <th class="text-center" colspan="2">Hoạt động</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                            @foreach ($giamgia as $gg)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td>{{ $gg->magg }}</td>
                                    <td>{{ number_format($gg->sotien) }}₫</td>
                                    <td>{{ number_format($gg->toithieu) }}₫</td>
                                    <td>{{ $gg->gioihan_luot }}</td>
                                    <td>{{ $gg->ngay_hethan }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success" href="/admin/sua-giamgia/{{ $gg->idgg }}">Sửa</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-xs" onclick="return Del('{{ $gg->magg }}')" href="/admin/xoa-giamgia/{{ $gg->idgg }}">Xóa</a>
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
        return confirm("Bạn có chắc chắn muốn xóa mã giảm giá này ?");
    }
</script>