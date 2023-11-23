@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Danh sách slider </h2>
                <a class="btn btn-primary" style="position: absolute; right: 5px; top: 17px" href="/admin/them-slider">Thêm mới</a>
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
                            <th class="text-center" colspan="2">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                            @foreach($slider as $sld)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td><img style="width: 100px;" src="{{asset('storage/img/banners/'.$sld->img)}}"></td>
                                    <td class="text-center">
                                        <a class="btn btn-success" href="/admin/sua-slider/{{ $sld->idsld }}">Sửa</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa slider này?');" href="/admin/xoa-slider/{{ $sld->idsld }}">Xóa</a>
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