@extends('home.layout')
@section('content')
    <section id="main">
        <div class="slider">
            <div class="container">
                <div class="owl-carousel-slider owl-carousel owl-theme">
                    @foreach ($slider as $sld)
                        <div class="item"><img style="width: 100%; height: 250px;" src="{{asset('storage/img/banners/'.$sld->img)}}"></div>	
                    @endforeach
                </div>
            </div>
        </div>
        <div class="container">
            <div class="slider1">
                <div class="kmhot"><a>Khuyến mãi hot</a></div>
                <div class="owl-carousel" >
                    @foreach ($spkm as $km)
                    <div class="item" style="margin: 0px;">
                        <div class="product">
                            <a class="img" href="/chitietsp/{{ $km->idsp }}" title="{{ $km->tensp }}" >
                                <img class="img-1" style="width:240px;" src="{{asset('storage/img/sanpham/'.$km->img)}}" alt="">
                            </a>
                            <div class="lt-product-group-info">
                                <h3 class="name">
                                    <a href="/chitietsp/{{ $km->idsp }}" title="{{ $km->tensp }}">{{ $km->tensp }}</a>
                                </h3>
                            </div>
                            <div class="price-index">
                                <div class="price-box">
                                    @if($km->gia_km > 0)
                                        <p class="special-price">
                                            <span class="price" style="color: #fff;">{{ number_format($km->gia_km)}}₫</span>
                                        </p>
                                        <p class="old-price">
                                            <span class="price">{{ number_format($km->gia)}}₫</span>
                                        </p>
                                    @else
                                        <p class="special-price">
                                            <span class="price" style="color: #fff;">{{ number_format($km->gia)}}₫</span>
                                        </p>
                                    @endif
                                </div>
                                <form action="/cart/{{ $km->idsp }}" method="post" id="ProductDetailsForm"> @csrf
                                    <button class="fa fa-cart-plus plus" name="sbm" type="submit" onclick="alert('Đã thêm sản phẩm vào giỏ hàng !')" style="margin-right: 10px;"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product-content" style="margin-top: 30px;">
                <div class="product-wrap">
                    <div class="collection" style="padding-bottom: 18px;">
                        <div class="name-all">
                            <h1>Sản phẩm nổi bật</h1>
                        </div>
                        <div class="collection-filter" id = "list-product">
                            <div class="category-products clearfix">
                                <div class="clearfix">
                                    @foreach ($spvip as $nb)
                                    <div class="col-md-3 col-lg-3 col-xs-6 col-6">
                                        <div class="product">
                                            <a class="img" href="/chitietsp/{{ $nb->idsp }}" title="{{ $nb->tensp }}" >
                                                <img class="img-1" src="{{asset('storage/img/sanpham/'.$nb->img)}}" alt="">
                                            </a>
                                            <div class="lt-product-group-info">
                                                <h3 class="name">
                                                    <a href="/chitietsp/{{ $nb->idsp }}" title="{{ $nb->tensp }}">{{ $nb->tensp }}</a>
                                                </h3>
                                            </div>
                                            <div class="price-index">
                                                <div class="price-box">
                                                    @if($nb->gia_km > 0)
                                                        <p class="special-price">
                                                            <span class="price" style="color: #fff;">{{ number_format($nb->gia_km) }}₫</span>
                                                        </p>
                                                        <p class="old-price">
                                                            <span class="price">{{ number_format($nb->gia) }}₫</span>
                                                        </p>
                                                    @else
                                                        <p class="special-price">
                                                            <span class="price" style="color: #fff;">{{ number_format($nb->gia) }}₫</span>
                                                        </p>
                                                    @endif
                                                </div>
                                                <form action="/cart/{{ $nb->idsp }}" method="post" id="ProductDetailsForm">@csrf
                                                    <button class="fa fa-cart-plus plus" name="sbm" type="submit" onclick="alert('Đã thêm sản phẩm vào giỏ hàng !')"></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product-content" style="margin-top: 30px;">
                <div class="product-wrap">
                    <div class="collection">
                        <div class="name-all">
                            <h1>Đề cử</h1>
                        </div>  
                        <div class="collection-filter" id = "list-product">
                            <div class="category-products clearfix">
                                <div class="clearfix">
                                    @foreach ($sanpham as $sp)
                                    <div class="col-md-3 col-lg-3 col-xs-6 col-6">
                                        <div class="product">
                                            <a class="img" href="/chitietsp/{{ $sp->idsp }}" title="{{ $sp->tensp }}" >
                                                <img class="img-1" src="{{asset('storage/img/sanpham/'.$sp->img)}}" alt="">
                                            </a>
                                            <div class="lt-product-group-info">
                                                <h3 class="name">
                                                    <a href="/chitietsp/{{ $sp->idsp }}" title="{{ $sp->tensp }}">{{ $sp->tensp }}</a>
                                                </h3>
                                            </div>
                                            <div class="price-index">
                                                <div class="price-box">
                                                    @if($sp->gia_km > 0)
                                                        <p class="special-price">
                                                            <span class="price" style="color: #fff;">{{ number_format($sp->gia_km) }}₫</span>
                                                        </p>
                                                        <p class="old-price">
                                                            <span class="price">{{ number_format($sp->gia) }}₫</span>
                                                        </p>
                                                    @else
                                                        <p class="special-price">
                                                            <span class="price" style="color: #fff;">{{ number_format($sp->gia) }}₫</span>
                                                        </p>
                                                    @endif
                                                </div>
                                                <form action="/cart/{{ $sp->idsp }}" method="post" id="ProductDetailsForm">@csrf
                                                    <button class="fa fa-cart-plus plus" name="sbm" type="submit" onclick="alert('Đã thêm sản phẩm vào giỏ hàng !')"></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="page">  
                            @include('page.page')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    $(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        margin:20,
        nav: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    })
    });
    </script>
@endsection