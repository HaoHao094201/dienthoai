@extends('home.layout')
@section('content')
    <section id="main">
        <div class="container">
            <div class="breadcrumbs">
                <ul>
                    <li class="home"><a href="/" title="Go to Home Page">Trang chủ</a> / </li>
                    <li class="category3">Sản phẩm</li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 products-sale-off">
                    <div class="filter">
                        <div class="filter_m"><h1>Hãng sản xuất</h1></div>
                        @foreach ($hangdt as $hdt)
                            <div class="clearfix fix">
                                <div class="entry-image">
                                    <input class="selector hangdt" type="checkbox" value="{{ $hdt->idhdt }}">{{ $hdt->tenloai }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 products-sale-off" style="margin-top: 30px;">
                    <div class="filter">
                        <div class="filter_m"><h1>Mức giá</h1></div>
                        <div class="clearfix fix">
                            <div class="entry-image">
                                <input class="selector gia" type="checkbox" value="1-9999999">Dưới 10 triệu
                            </div>
                        </div>
                        <div class="clearfix fix">
                            <div class="entry-image">
                                <input class="selector gia" type="checkbox" value="10000000-15000000">Từ 10 - 15 triệu
                            </div>
                        </div>
                        <div class="clearfix fix">
                            <div class="entry-image">
                                <input class="selector gia" type="checkbox" value="15000000-20000000">Từ 15 - 20 triệu
                            </div>
                        </div>
                        <div class="clearfix fix">
                            <div class="entry-image">
                                <input class="selector gia" type="checkbox" value="20000000-25000000">Từ 20 - 25 triệu
                            </div>
                        </div>
                        <div class="clearfix fix">
                            <div class="entry-image">
                                <input class="selector gia" type="checkbox" value="25000000-100000000">Trên 25 triệu
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 product-content" >
                <div class="product-wrap" style="margin-left: 10px;">
                    <div class="collection show">
                                    
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            filter_data();

            function filter_data(){
                var action = 'get_data';
                var hangdt = get_filter('hangdt');
                var gia = get_filter('gia');
                
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
                $.ajax({
                    url:'/sanpham',
                    method:"POST",
                    data : {action:action, hangdt:hangdt, gia:gia},
                    success: function(data){
                        $('.show').html(data);
                    }
                });
            }
            function get_filter(class_name){
                var filter = [];
                $('.'+class_name+':checked').each(function(){
                    filter.push($(this).val());
                });
                return filter;
            }
            $('.selector').click(function(){
                filter_data();
            });
        });
    </script>
@endsection
