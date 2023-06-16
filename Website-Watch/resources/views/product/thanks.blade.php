@extends('layouts.app')
@section('content')
    <div class="body-product-cart">
        <div class="body-cart mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="row pb-3"><strong class=" d-flex justify-content-center"
                            style="font-size: 30px; font-family: 'Oswald', sans-serif;">THANH TOÁN TRỰC TUYẾN @if ($Status == 1)
                                {{ 'THÀNH CÔNG' }}
                            @else
                                {{ 'THẤT BẠI' }}
                            @endif
                        </strong></div>
                    <div class="col cart">
                        <img id="imgcart" src="{{ asset('/images/cat.gif') }}" alt="">
                        <h4 id="mesag-cart">
                            <p></p>
                        </h4>
                        <div class="row">
                            <div class="col-6"><a href="{{ url('shop/') }}" id="back-to-shop"><button type="button"
                                        class="buttonBack"><i class="fas fa-arrow-left"></i> Tiếp tục xem sản
                                        phẩm</button></a></div>
                            <div class="col-6 d-flex justify-content-center "><a
                                    href="{{ url('/lich-su-dat-hang') }}"><button type="button" class="buttonBack">Lịch sử
                                        mua hàng <i class="fas fa-arrow-right"></i>
                                    </button></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
