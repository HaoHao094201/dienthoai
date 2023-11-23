@if($hangdt != null)
    <div class="name-all">
        @foreach ($hangdt as $lsp)
            <h1>{{ $lsp->tenloai }}</h1>
        @endforeach
    </div>
@else
    <div class="name-all">
        <h1>Tất cả sản phẩm</h1>
    </div>
@endif
<div class="collection-filter" id = "list-product">
    <div class="category-products clearfix">
        <div class="clearfix"> 
            @if(count($sanpham) > 0)
                @foreach ($sanpham as $sp)
                    <div class="col-md-4 col-lg-4 col-xs-6 col-6">
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
            @else
                <div class="cart-info">Không có sản phẩm nào !</div>
            @endif	
        </div>
    </div>
</div>
