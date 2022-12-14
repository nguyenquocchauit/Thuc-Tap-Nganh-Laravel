@extends('layouts.app')
@section('content')
    <div class="body-product-cart">
        <div class="body-cart mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="row pb-3"><strong class=" d-flex justify-content-center"
                            style="font-size: 30px; font-family: 'Oswald', sans-serif;">GIỎ HÀNG CỦA BẠN</strong></div>
                    <div class="col cart">
                        @php $cart = session()->get('cart'); @endphp
                        @if (isset($cart))
                            @include('product/list_cart')
                        @else
                            <img id='imgcart' src='{{ asset('/images/cat.gif') }}' alt=''>
                            <h4 id='mesag-cart'>
                                <p>Giỏ hàng hiện tại trống, quay lại trang shop đặt hàng</p>
                            </h4>
                            <a href='shop.php' id='back-to-shop'><button type='button' class='buttonBack'><i
                                        class="fas fa-arrow-left"></i> Tiếp tục xem sản phẩm</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
