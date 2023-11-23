@extends('home.layout')
@section('content')
    @if(!Session::has('taikhoan'))
        <script>
            $(document).ready(function(){
            $('#myModal').modal(); 
            });
        </script>
        <section id="main">
            <div class="cart-info">
                Bạn cần đăng nhập để sử dụng chức năng này !
                <div class="button-order">
                    <button type="submit" name="sbm" class="button btn-cart add_to_cart_detail detail-button" data-toggle="modal" data-target="#myModal">Đăng nhập</button>
                </div>
            </div>
        </section>
    @endif
@endsection
