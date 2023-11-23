@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Danh sách các bình luận</h2>
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
                            <th>Sản phẩm bình luận</th>
                            <th>Tên khách hàng</th>
                            <th>Ngày</th>
                            <th>Nội dung bình luận</th>
                            <th class="text-center">Hoạt động</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                            @foreach ($binhluan as $bl)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td>{{ $bl->tensp }}</td>
                                    <td>{{ $bl->tenkh }}</td>
                                    <td>{{ $bl->ngay }}</td>
                                    <td>{{ $bl->binhluan }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-xs" onclick="return Del('{{ $bl->tenkh }}')" href="/admin/xoa-binhluan/{{ $bl->idbl }}">Xóa</a>
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
        return confirm("Bạn có chắc chắn muốn xóa bình luận này của: "+name+" ?");
    }
</script>