<table>
    <tr class="tr1">
        <td>
            <p>STT</p>
        </td>
        <td>
            <p>Sản phẩm</p>
        </td>
        <td>
            <p>Tên sản phẩm</p>
        </td>
        <td>
            <p>Giá</p>
        </td>
        <td>
            <p>Số lượng</p>
        </td>
        <td>
            <p>Tổng</p>
        </td>
        <td>
            <p>Xóa</p>
        </td>
    </tr>
    <tbody>
        @php $total = 0 @endphp
        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr>
                    <td>
                        {{ $id }}
                    </td>
                    <td style="width: 15%;">
                        <div class="divimg"><img src="" alt=""
                                srcset="">
                        </div>
                    </td>
                    <td style="width: 26%;"><span>{{ $details['name'] }}</span></td>
                    <td>
                        <p>{{ number_format($details['price']) . ' VNĐ' }}</p>
                    </td>
                    <td>
                        <div class="quantity numbers-row">
                            <div class="row">
                                <div class="col-4 d-flex justify-content-end pt-1 asc"></div>
                                <div class="col-4 inpqan">
                                    <input type="text" class="form-control inpquantity"
                                        value="{{ $details['quantity'] }}">
                                    <input type="hidden" name="" class="ID_Quantity" value="">
                                </div>
                                <div class="col-4 d-flex justify-content-start pt-1 desc"></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p>{{ number_format($details['priceDiscount']) . ' VNĐ' }}</p>
                    </td>
                    <td><a href=""><i class="far fa-times-circle"></i></a></td>
                </tr>
            @endforeach
        @endif
        <tr class="tr1">
            <td></td>
            <td colspan="1">
                <p>Tổng tiền</p>
            </td>
            <td colspan="5" style="text-align: end;color: red;">
                <p>{{ number_format($total) . ' VNĐ' }}</p>
            </td>
        </tr>
        <tr class="tr1">
            <td></td>
            <td colspan="1">
                <p>Giao hàng</p>
            </td>
            <td colspan="5" style="text-align: end;">
                <p>Giao hàng miễn phí</p>
            </td>
        </tr>
        <td></td>
        <td style="text-align: end;">
            <a href="shop.php"><button type="button" class="buttonBack"><i class="fas fa-arrow-left"
                        id="iconback"></i> Tiếp tục xem sản phẩm</button></a>
        </td>
        <td style="text-align: center;">
            <button type="button" class="buttonDelete" id="remove-all-cart"><i class="fas fa-trash"></i> Xóa giỏ
                hàng</button>
        </td>
        <td colspan="4" style="text-align: end;">
            <form action="" method="post">
                <button type="button" class="buttonBuy" name="buttonBuy"><i class="fa-solid fa-pen-to-square"></i> Đặt
                    hàng</button>
                <input type="hidden" class="CurrentUser" value="' . ($CurrentUser) . '">
                <input type="hidden" class="IDUser" value="' . ($IDUser) . '">
                <input type="hidden" class="timeNow" value="' . ($timeNow) . '">
                <input type="hidden" class="sum" value="' . ($sum) . '">
            </form>
        </td>
        </tr>

    </tbody>
</table>
