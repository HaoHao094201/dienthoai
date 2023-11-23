@extends('home.layout')
@section('content')
    <section id="main">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product-content">
                <div class="product-wrap">
                    <div class="collection">
                        <h3 style="margin-left: 14px;"><span>Tìm thấy <span style="font-weight: 700;">{{ count($sp) }}</span> kết quả với từ khoá <span style="font-weight: 700;">"{{ $timkiem }}"</span></span></h3>
                        <div class="collection-filter" id = "list-product">
                            <div class="category-products clearfix">
                                <div class="clearfix">
                                    @foreach ($sanpham as $sp)
                                        <div class="col-md-3 col-lg-3 col-xs-6 col-6">
                                            <div class="product">
                                                <a class="img" href="/chitietsp/{{ $sp->idsp }}" title="{{ $sp->tensp }}" >
                                                    <img class="img-1"src="{{asset('storage/img/sanpham/'.$sp->img)}}" alt="">
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
                                                        <button class="fa fa-cart-plus plus" name="sbm" type="submit" onclick="alert('Đã thêm sản phẩm vào giỏ hàng !')" style="margin-right: 10px;"></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="page">  
                            <?php
                            if ($current_page > 3) {
                                $first_page = 1;
                                ?>
                            <a class="page-item" href="?timkiem={{ $timkiem }}&per_page=<?= $item_per_page ?>&page=<?= $first_page ?>"><i class="fa fa-angle-double-left"></i></a>
                            <?php
                            }
                            if ($current_page > 1) {
                                $prev_page = $current_page - 1;
                                ?>
                            <a class="page-item" href="?timkiem={{ $timkiem }}&per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>"><i class="fa fa-angle-left"></i></a>
                            <?php }
                            ?>
                            <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
                                <?php if ($num != $current_page) { ?>
                                    <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                                        <a class="page-item" href="?timkiem={{ $timkiem }}&per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <strong class="numss page-item"><?= $num ?></strong>
                                <?php } ?>
                            <?php } ?>
                            <?php
                            if ($current_page < $totalPages - 1) {
                                $next_page = $current_page + 1;
                                ?>
                                <a class="page-item" href="?timkiem={{ $timkiem }}&per_page=<?= $item_per_page ?>&page=<?= $next_page ?>"><i class="fa fa-angle-right"></i></a>
                            <?php
                            }
                            if ($current_page < $totalPages - 3) {
                                $end_page = $totalPages;
                                ?>
                                <a class="page-item" href="?timkiem={{ $timkiem }}&per_page=<?= $item_per_page ?>&page=<?= $end_page ?>"><i class="fa fa-angle-double-right"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
