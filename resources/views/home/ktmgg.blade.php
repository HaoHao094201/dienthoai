@if(empty($magg))
    <p>Vui lòng nhập Mã giảm giá nếu có !!</p>
@else
    <?php $tong = 0; ?>
    @foreach (Session::get('giohang') as $rowsp ) 
        @if($rowsp['gia_km'] > 0)
            <?php $giatien = $rowsp['gia_km'] * $rowsp['soluong']; ?>
        @else
            <?php $giatien = $rowsp['gia'] * $rowsp['soluong']; ?>
        @endif
        <?php $tong += $giatien; ?>
    @endforeach
    @if(Session::get('giamgia') != null)
        <p>Mỗi đơn hàng chỉ áp dụng 1 Mã giảm giá!</p>
    @else
        @if($giamgia)
            @if($giamgia->magg == $magg)
                @if(strtotime($giamgia->ngay_hethan) <= strtotime($ngay))
                    <p>Mã giảm giá {{ $giamgia->magg }} đã hết hạn sử dụng từ ngày {{ $giamgia->ngay_hethan }} !</p>
                @elseif($giamgia->gioihan_luot - $giamgia->sl_nhap == 0)
                    <p>Mã giảm giá {{ $giamgia->magg }} đã hết số lần nhập !</p>
                @elseif($giamgia->toithieu > $tong )
                    <p> Mã giảm giá này chỉ áp dụng cho đơn hàng từ {{ number_format($giamgia->toithieu) }} đ trở lên !</p>
                @else
                    <script>document.location.reload(true);</script>
                    <?php 
                        $gg =[
                            'sotien' => $giamgia['sotien'],
                            'idgg' => $giamgia['idgg'],
                        ];
                        Session::put('giamgia', $gg);  
                    ?>
                @endif
            @endif
        @else
            <p>Mã giảm giá không tồn tại!</p>
        @endif
    @endif
@endif    


