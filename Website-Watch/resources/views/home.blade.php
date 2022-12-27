@extends('layouts.app')
@section('content')
    <div class="body">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-4 content-item d-flex">

                        <img class="imgitem" src="{{ asset('images/24-hours-phone-service-300x300.png') }}" alt="">
                        <h3>Phục vụ 24/7</h3>
                    </div>
                    <div class="col-4 content-item  d-flex ">
                        <img class="imgitem" src="{{ asset('images/logistics-delivery-truck-in-movement-300x300.png') }}"
                            alt="">
                        <h3>Giao hàng tận nơi</h3>
                    </div>
                    <div class="col-4 content-item  d-flex">
                        <img class="imgitem" src="{{ asset('images/gift-300x300.png') }}" alt="">
                        <h3>Miễn phí vận chuyển</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="productlist">
            <div class="product mt-5">
                <h2 class="tc-title ">Danh mục sản phẩm</h2>
                <div class="thanh">
                    <div class="ngang" id="ngang1"></div>
                    <div class="clock"><i class="far fa-clock"></i></div>
                    <div class="ngang" id="ngang2"></div>
                </div>
                <div class="container mt-5">
                    <div id="wapper">
                        <div class="filtering">
                            <!-- duyệt danh sách  tất cả sản phẩm: ảnh, tên, số lượng có sẵn -->
                            @foreach ($allProducts as $allProduct)
                                <div class="item">
                                    <div class="wap-items-ss brbox">
                                        <div class="wap-ss-img">
                                            <img alt=""
                                                src="{{ asset('images/image_products_home') . '/' . $allProduct->productImage['image_1'] }}">
                                        </div>
                                        <div class="textleft">
                                            <div style="line-height: 12px;"><a
                                                    href="{{ url('chi-tiet-san-pham/') }}/{{ $allProduct->id }}"></div>
                                            {{ $allProduct->name }}</a>
                                            <div><b>
                                                    @if ($allProduct->quantity == 0)
                                                        {{ 'Hết hàng' }}
                                                    @else
                                                        {{ $allProduct->quantity . ' sản phẩm' }}
                                                    @endif
                                                </b></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-sale mt-5">
                <h2 class="tc-title">Sản phẩm giảm giá</h2>
                <div class="thanh">
                    <div class="ngang" id="ngang1"></div>
                    <div class="clock"><i class="far fa-clock"></i></div>
                    <div class="ngang" id="ngang2"></div>
                </div>
                <div class="container mt-5">
                    <div id="wapper">
                        <div class="filtering">
                            <!-- duyệt danh sách  tất cả sản phẩm: giá được giảm, ảnh, tên, số lượng có sẵn -->
                            @foreach ($allProducts as $allProduct)
                                @if ($allProduct->discount > 0)
                                    <div class="item">
                                        <div class="sale">
                                            -{{ $allProduct->discount }} %
                                        </div>
                                        {{-- get liked product by user logined --}}
                                        <div
                                            class="icon-heart like-product product-{{ $allProduct->id }} @if (Auth::check()) @foreach ($liked as $like)
                                        @if ($like->product == $allProduct->id && $like->customers == Auth::user()->id && $like->status == 'like')
                                            {{ 'liked' }} @endif @endforeach   @endif">
                                            <i class="fa fa-heart"></i>
                                            <input type="hidden" class="idProduct" value="{{ $allProduct->id }}">
                                        </div>
                                        <div class="wap-items-ss brbox product-item ">
                                            <div class="wap-ss-img product-item-img">
                                                <img alt=""
                                                    src="{{ asset('images/image_products_home') . '/' . $allProduct->productImage['image_1'] }}">
                                            </div>
                                            <div class="textleft product-item-desc">
                                                <div style="line-height: 12px;"><a
                                                        href="{{ url('chi-tiet-san-pham/') }}/{{ $allProduct->id }}">{{ $allProduct->name }}</a>
                                                </div>
                                                <div class="price d-flex ">
                                                    <!-- number_format dùng định dạng số theo kiểu đơn vị tiền tệ -->
                                                    <span
                                                        class="price-pre">{{ number_format($allProduct->price) . ' VNĐ' }}</span>
                                                    <!-- xử lý in giá bán sau khi áp dụng giảm giá -->
                                                    <span
                                                        class="price-sale">{{ number_format($allProduct->price - $allProduct->price * ($allProduct->discount / 100)) . ' VNĐ' }}</span>
                                                </div>
                                                <div class="product-item-desc-button-submit">
                                                    <button type="submit" class="btn btn-light add-to-cart"
                                                        name="add-to-cart"><i
                                                            class="fas fa-cart-plus mx-2 shopping-cart"></i>Thêm vào
                                                        giỏ</button>
                                                    <input type="hidden" name="productID" class="productID"
                                                        value="{{ $allProduct->id }}">
                                                    <input type="hidden" name="productName" class="productName"
                                                        value="{{ $allProduct->name }}">
                                                    <input type="hidden" name="productImage" class="productImage"
                                                        value="{{ $allProduct->productImage['image_1'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- nếu có sản phẩm nổi bật thì hiển thị --}}
            @if (count($bestSellingProducts))
                <div class="product-hot mt-5">
                    <h2 class="tc-title">Sản phẩm nổi bật</h2>
                    <div class="thanh">
                        <div class="ngang" id="ngang1"></div>
                        <div class="clock"><i class="far fa-clock"></i></div>
                        <div class="ngang" id="ngang2"></div>
                    </div>
                    <div class="container mt-5">
                        <div id="wapper">
                            <div class="filtering">
                                <!-- duyệt danh sách  tất cả sản phẩm theo danh sách sp bán chạy nhất top 2: giá được giảm, ảnh, tên, số lượng có sẵn -->
                                @foreach ($bestSellingProducts as $bestSellingProduct)
                                    <div class="item">
                                        @if ($bestSellingProduct->discount > 0)
                                            <div class="sale">
                                                <!-- đổi số thập phân sang dạng phần trăm -->
                                                {{ '-' . $bestSellingProduct->discount . '%' }}
                                            </div>
                                        @endif
                                        {{-- get liked product by user logined --}}
                                        <div
                                            class="icon-heart like-product product-{{ $bestSellingProduct->id }} @if (Auth::check()) @foreach ($liked as $like)
                                        @if ($like->product == $bestSellingProduct->id && $like->customers == Auth::user()->id && $like->status == 'like')
                                            {{ 'liked' }} @endif @endforeach @endif ">
                                            <i class="fa fa-heart"></i>
                                            <input type="hidden" class="idProduct" value="{{ $bestSellingProduct->id }}"
                                                data-id="product-{{ $bestSellingProduct->id }}">
                                        </div>
                                        <div class="wap-items-ss brbox product-item">
                                            <div class="wap-ss-img product-item-img">
                                                <!-- Image lưu trữ nhiều ảnh, tách dữ liệu lấy ảnh đầu tiên. Các ảnh được ngăn cách bởi dấu , -->
                                                <img alt=""
                                                    src="{{ asset('images/image_products_home') . '/' . $bestSellingProduct->productImage['image_1'] }}">
                                            </div>
                                            <div class="textleft product-item-desc">
                                                <div style="line-height: 12px;"><a
                                                        href="{{ url('chi-tiet-san-pham/') }}/{{ $bestSellingProduct->id }}">{{ $bestSellingProduct->name }}</a>
                                                </div>
                                                <div class="price d-flex ">
                                                    <!-- number_format dùng định dạng số theo kiểu đơn vị tiền tệ -->
                                                    <p class="price-pre">{{ number_format($bestSellingProduct->price) }}
                                                    </p>
                                                    <p>
                                                        <!-- xử lý in giá bán sau khi áp dụng giảm giá -->
                                                        {{ number_format($bestSellingProduct->price - $bestSellingProduct->price * ($bestSellingProduct->discount / 100)) }}
                                                        VNĐ
                                                    </p>
                                                </div>
                                                <div class="product-item-desc-button-submit">
                                                    <button type="submit" class="btn btn-light add-to-cart"
                                                        name="add-to-cart"><i
                                                            class="fas fa-cart-plus mx-2 shopping-cart"></i>Thêm
                                                        vào
                                                        giỏ</button>
                                                    <input type="hidden" name="productID" class="productID"
                                                        value="{{ $bestSellingProduct->id }}">
                                                    <input type="hidden" name="productName" class="productName"
                                                        value="{{ $bestSellingProduct->name }}">
                                                    <input type="hidden" name="productImage" class="productImage"
                                                        value="{{ $bestSellingProduct->productImage['image_1'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="feedback mt-5">
                <h2 class="tc-title">Feed back từ khách hàng</h2>
                <div class="thanh">
                    <div class="ngang" id="ngang1"></div>
                    <div class="clock"><i class="far fa-clock"></i></div>
                    <div class="ngang" id="ngang2"></div>
                </div>
                <div class="blog-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ asset('images/gg-1000-1a8dr-01.png') }}" alt=""
                                    class="imgfeedback">
                                <div class="row mt-4">
                                    <div class="col-1">

                                        <img src="{{ asset('images/feedbacknqc.png') }}" alt="">
                                    </div>
                                    <div class="col-4">
                                        <p>Quốc Châu</p>
                                    </div>
                                    <div class="col-7 d-flex">
                                        <p>27 tháng 8</p>
                                        <p><i class="far fa-heart"></i></i>99</p>
                                        <p><i class="far fa-comment"></i>2</p>
                                    </div>
                                    <hr>
                                    <p style="padding: 0px 50px 0px 5px;">Tôi thực sự an tâm và tin tưởng vào chất lượng
                                        dịch vụ của TCWatch. Lần đầu tiên thấy chiếc đồng hồ của mình được chăm...</p>
                                </div>
                            </div>
                            <div class="col-4">

                                <img src="{{ asset('images/ga-1100-2bdr-01.png') }}" alt="" class="imgfeedback">
                                <div class="row mt-4">
                                    <div class="col-1">

                                        <img src="{{ asset('images/feedbackdkl.png') }}" alt="">
                                    </div>
                                    <div class="col-4">
                                        <p>Dương Khắc Linh</p>
                                    </div>
                                    <div class="col-7 d-flex">
                                        <p>01 tháng 12</p>
                                        <p><i class="far fa-heart"></i></i>55</p>
                                        <p><i class="far fa-comment"></i>14</p>
                                    </div>
                                    <hr>
                                    <p style="padding: 0px 50px 0px 5px;">Điều mà Linh ấn tượng nhất là chế độ bảo hành 5
                                        năm theo tiêu chuẩn Thuỵ Sĩ cho cả lỗi người dùng. Điều này không phải... </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <img src="{{ asset('images/gst-b100d-1a9dr-01.png') }}" alt=""
                                    class="imgfeedback">
                                <div class="rosw mt-4">
                                    <div class="col-1">

                                        <img src="{{ asset('images/feedbackxb.png') }}" alt="">
                                    </div>
                                    <div class="col-4">
                                        <p>Xuân Bắc</p>
                                    </div>
                                    <div class="col-7 d-flex">
                                        <p>19 tháng 5</p>
                                        <p><i class="far fa-heart"></i></i>78</p>
                                        <p><i class="far fa-comment"></i>8</p>
                                    </div>
                                    <hr>
                                    <p style="padding: 0px 50px 0px 5px;">Tôi ủng hộ những người đặt lợi ích của khách hàng
                                        làm mục tiêu phấn đấu. Vì vậy, tôi đã ủng hộ và lựa chọn TCWatch...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
