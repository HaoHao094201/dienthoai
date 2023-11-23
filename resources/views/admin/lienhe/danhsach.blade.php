@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Danh sách liên hệ</h2>
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
                            <th>Tên</th>
                            <th>Tiêu đề</th>
                            <th>Ngày gửi</th>
                            <th class="text-center" colspan="2">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                            @foreach ($lienhe as $lh)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td>{{ $lh->ten }}</td>
                                    <td>{{ $lh->tieude }}</td>
                                    <td>{{ $lh->ngay }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="/admin/chitiet-lienhe/{{ $lh->idlh }}">Xem</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-xs" onclick="return Del('{{ $lh->ten }}')" href="/admin/xoa-lienhe/{{ $lh->idlh }}">Xóa</a>
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
        return confirm("Bạn có chắc chắn muốn xóa liên hệ này ?");
    }
</script>