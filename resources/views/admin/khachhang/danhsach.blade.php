@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Danh sách khách hàng</h2>
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
                            <th>Tên khách hàng</th>
                            <th>Điện thoại</th>
                            <th>Email</th>
                            <th class="text-center">Hoạt động</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                            @foreach ($khachhang as $kh)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td>{{ $kh->tenkh }}</td>
                                    <td>{{ $kh->sdt }}</td>
                                    <td>{{ $kh->email }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-xs" onclick="return Del('{{ $kh->tenkh }}')" href="/admin/xoa-khachhang/{{ $kh->idkh }}">Xóa</a>
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
        return confirm("Bạn có chắc chắn muốn xóa khách hàng: "+name+" ?");
    }
</script>