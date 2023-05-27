<section class="h-100 gradient-custom">
    <div class="container ">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-start">
                                <h5 class="mb-0"><a href="/shop"><i class="fas fa-long-arrow-alt-left"></i></a> Giỏ
                                    hàng - 2 sản phẩm</h5>
                            </div>
                            <div class="col-6 d-flex justify-content-end"><button type="button" id="remove-all-cart"
                                    style="border: none; background-color: #f7f7f7;">xóa giỏ hàng <i style="color: red;"
                                        class="far fa-trash-alt"></i></button></div>
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                            $total = 0;
                            $i = 1;
                        @endphp
                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                @php $total += $details['priceDiscount'] * $details['quantity'] @endphp
                                <!-- Single item -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                        <!-- Image -->
                                        <div class="bg-image hover-overlay hover-zoom ripple rounded text-center"
                                            data-mdb-ripple-color="light">
                                            <img src="{{ asset('images/image_products_home/') }}/{{ $details['image'] }}"
                                                class="w-50" alt="Watch" style="" />
                                        </div>
                                        <!-- Image -->
                                    </div>
                                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                        <!-- Data -->
                                        <p><strong>{{ $details['name'] }}</strong></p>
                                        <p>Loại: {{ $details['gender'] }}</p>
                                        <p>Hãng: {{ $details['brand'] }}</p>
                                        <a href="{{ url('api/remove-product-by-id/') }}/{{ $id }}">
                                            <button type="button" class="btn btn-danger btn-sm me-1 mb-2"
                                                data-mdb-toggle="tooltip" title="Xóa khỏi giỏ hàng">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </a>
                                        <a href="/chi-tiet-san-pham/{{ $id }}">
                                            <button type="button" class="btn btn-success btn-sm mb-2"
                                                data-mdb-toggle="tooltip" title="Xem chi tiết sản phẩm">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </a>
                                        <!-- Data -->
                                    </div>
                                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                        <!-- Quantity -->
                                        <div class="d-flex mb-4 justify-content-center product-quantity"
                                            style="max-width: 300px">
                                            <button class="btn btn-primary px-3 me-2 btn-quantity-cart">-</button>

                                            <div class="form-outline inp-quantity-cart" style="width:20%">
                                                <input class="form-control quantity-cart" type="text"
                                                    name="quantity-cart" value="{{ $details['quantity'] }}"
                                                    style="text-align: center;" />
                                                <input type="hidden" name="" class="ID_Quantity"
                                                    value="{{ $id }}">
                                            </div>

                                            <button class="btn btn-primary px-3 ms-2 btn-quantity-cart">+</button>
                                        </div>
                                        <!-- Quantity -->
                                        <!-- Price -->
                                        <p class="text-start text-md-center">
                                            <strong>{{ number_format($details['total']) . ' VNĐ' }}</strong>
                                        </p>
                                        <!-- Price -->
                                    </div>
                                </div>
                                <!-- Single item -->
                                <hr class="my-4" />
                                @php $i++; @endphp
                            @endforeach
                        @endif

                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <p><strong>Giao hàng dự kiến</strong></p>
                        {{-- giao hàng trong vòng 4 ngày  --}}
                        <p class="mb-0">
                            {{ date('d/m/Y', strtotime($time)) . ' - ' . date('d/m/Y', strtotime($time . ' +4 days')) }}
                        </p>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body">
                        <p><strong>Phương thức thanh toán trực tuyến</strong></p>
                        <img class="me-2" width="45px"
                            src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                            alt="Visa" />
                        <img class="me-2" width="45px"
                            src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                            alt="American Express" />
                        <img class="me-2" width="45px"
                            src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                            alt="Mastercard" />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Tổng quan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Sản phẩm
                                <span>{{ number_format($total) . ' VNĐ' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Vận chuyển
                                <span>Miễn phí</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Tổng thanh toán</strong>
                                    <strong>
                                        <p class="mb-0">(bao gồm VAT 8%)</p>
                                    </strong>
                                </div>
                                <span><strong>@php $totalVAT = $total + ($total * 0.08);   @endphp {{ number_format($totalVAT) . ' VNĐ' }}</strong></span>
                            </li>
                        </ul>

                        <button type="button" class="btn btn-primary btn-lg btn-block " id="buy-product">
                            Thanh toán
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
