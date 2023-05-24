@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/shop.css') }}" />


    {{-- Product Shop Section Begin --}}
    <section class="product-shop spad mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 products-sidebar-filter">
                    <form action="">
                        <div class="filter-wiget">
                            <h4 class="fw-title">Loại</h4>
                            <ul class="filter-categories">
                                <li><a
                                        href="{{ route('shop-index') }}/men }}">Nam</a>
                                </li>
                                <li><a
                                    href="{{ route('shop-index') }}/women }}">Nữ</a>
                            </li>
                                {{-- @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('shop-index') }}/{{ ucfirst(trans($category->slug)) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach --}}
                            </ul>
                        </div>
                        <div class="filter-wiget">
                            <h4 class="fw-title">Hãng</h4>
                            <div class="fw-brand-check">
                                @foreach ($brands as $brand)
                                    <div class="bc-item">
                                        <label for="bc-{{ $brand->id }}">
                                            {{ $brand->name }}
                                            <input type="checkbox"
                                                {{ (request('brand')[$brand->id] ?? '') == 'on' ? 'checked' : '' }}
                                                id="bc-{{ $brand->id }}" name="brand[{{ $brand->id }}]"
                                                onchange="this.form.submit();">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="filter-wiget">
                            <h4 class="fw-title">Giá</h4>
                            <label for="amount">Lọc theo giá</label>
                            <form>
                                <div id="slider-range">
                                </div>
                                <div class="slider-range">
                                    <p><input type="text" id="amount_start" readonly
                                            style="border:0; color:#f6931f; font-weight:bold;background-color: #f8fafc;">
                                    </p>
                                    <p><input type="text" id="amount_end" readonly
                                            style="border:0; color:#f6931f; font-weight:bold;width: 100px;background-color: #f8fafc;">
                                    </p>
                                </div>
                                <input type="hidden" name="start_price" id="start_price" value="{{ old('start_price') }}">
                                <input type="hidden" name="end_price" id="end_price" value="{{ old('end_price') }}">

                                <input type="submit" name="filter_price" class="filter-btn" value="Lọc">
                            </form>
                        </div>
                    </form>
                    <div class="brands-wishlist">
                        {{-- kiểm tra người dùng đã đăng nhập chưa --}}
                        @guest
                            <h4 class="brand-title">Đăng nhập để xem sản phẩm yêu thích</h4>
                        @else
                            {{-- duyệt danh sách thích có trong db  tương ứng với user đang đăng nhập --}}

                            <div class="row">
                                <div class="col-8 d-flex justify-content-start">
                                    <h4 class="brand-title">Sản phẩm yêu thích </h4>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <button type="button " id="clear-like-product"><strong>xóa tất cả</strong></button>
                                </div>
                            </div>

                            <div id="row_wishlist" class="row">
                                @foreach ($liked as $like)
                                    @if ($like->status == 'like' && $like->customers == Auth::user()->id)
                                        <div class="row list-like-product product--{{ $like->product }}" style="margin: 10px 0"
                                            data-id="{{ $like->product }}">
                                            @php
                                                $nameImage = $like->products->productImage['image_1'];
                                            @endphp
                                            <div class="col-md-4"><img
                                                    src="{{ asset('images/image_products_home') . '/' . $nameImage }}"
                                                    width="100%"></div>
                                            <div class="col-md-8">
                                                <p>{{ $like->products['name'] }}</p>
                                                <p style="color:#fe980f">@php $price = $like->products['price']-($like->products['price'] * ($like->products['discount']/100)) @endphp {{ number_format($price) . ' VNĐ' }}
                                                </p>
                                                <a class="btn btn-success" href="/chi-tiet-san-pham/{{ $like->product }}">Chi
                                                    tiết</a>
                                                <a class="btn btn-danger btn-xs delete_wishlist remove-like-product"
                                                    style="margin-top:0">Xóa</a>
                                                <input type="hidden" class="idProduct" value="{{ $like->product }}">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-12 col-4 d-flex justify-content-end ">
                                    <button type="button" class="btn btn-success mb-1" id="buy-all-like-product">Đặt mua tất
                                        cả</button>
                                </div>
                            </div>
                        @endguest

                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                            <form action="">
                                <div class="select-option">
                                    <select class="sorting" name="sort_by" onchange="this.form.submit();"
                                        style="border-radius: 10px;border: solid #eef2f7;">
                                        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>
                                            Sắp xếp: Mới nhất</option>
                                        <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>
                                            Sắp xếp: Cũ nhất</option>
                                        <option value="name-ascending"
                                            {{ request('sort_by') == 'name-ascending' ? 'selected' : '' }}>Sắp xếp: A-Z
                                        </option>
                                        <option value="name-descending"
                                            {{ request('sort_by') == 'name-descending' ? 'selected' : '' }}>Sắp xếp: Z-A
                                        </option>
                                        <option value="price-ascending"
                                            {{ request('sort_by') == 'price-ascending' ? 'selected' : '' }}>Sắp xếp: Giá
                                            tăng dần </option>
                                        <option value="price-descending"
                                            {{ request('sort_by') == 'price-descending' ? 'selected' : '' }}>Sắp xếp: Giá
                                            giảm dần</option>
                                    </select>
                                    <select class="p-show" name="show" onchange="this.form.submit();"
                                        style="border-radius: 10px;border: solid #eef2f7;">
                                        <option value="6" {{ request('show') == '6' ? 'selected' : '' }}>Hiển thị: 6
                                        </option>
                                        <option value="9" {{ request('show') == '9' ? 'selected' : '' }}>Hiển thị: 9
                                        </option>
                                        <option value="15" {{ request('show') == '15' ? 'selected' : '' }}>Hiển thị:
                                            15
                                        </option>
                                    </select>
                                </div>
                            </form>
                            <div class="col-lg-7 col-md-7">
                            </div>

                            <div class="col-lg-5 col-md-5 text-right">

                            </div>
                        </div>
                    </div>
                    <ul class="product-list">
                        @foreach ($products as $product)
                            <li>
                                <div class="product">
                                    <a href="#" class="product-image product-item-img">
                                        <img src="/images/image_products_home/{{ $product->productImage['image_1'] }}"
                                            alt="Product">
                                    </a>
                                    @if ($product->discount != null)
                                        <div class="sale pp-sale">{{ $product->discount }}%</div>
                                    @endif
                                    <div
                                        class="btn-wishlist like-product product-{{ $product->id }}  @if (Auth::check()) @foreach ($liked as $like)
                                        @if ($like->product == $product->id && $like->customers == Auth::user()->id && $like->status == 'like')
                                            {{ 'liked' }} @endif @endforeach   @endif">
                                        <i class="fa fa-heart"></i>
                                    </div>
                                    <input type="hidden" class="idProduct" value="{{ $product->id }}">

                                    <div class="quick-view-controller" style="justify-content: center;">
                                        <p class="product-item-desc-button-submit">
                                            <a class="btn-cart add-to-cart">
                                                <i class="fas fa-cart-plus" style="color:black "></i>
                                            </a>
                                            <input type="hidden" name="productID" class="productID"
                                                value="{{ $product->id }}">
                                            <input type="hidden" id="product_name{{ $product->id }}"
                                                name="productName" class="productName" value="{{ $product->name }}">
                                            <input type="hidden" id="product_price{{ $product->id }}"
                                                name="productName" class="productName"
                                                value="{{ $product->discount != null ? number_format($product->price - $product->price * ($product->discount / 100)) : number_format($product->price) }} VNĐ">
                                            <input type="hidden" id="product_image{{ $product->id }}"
                                                src="{{ URL::to('/images/image_products_home/' . $product->productImage['image_1']) }}"
                                                name="productImage" class="productImage"
                                                value="{{ $product->productImage['image_1'] }}">
                                        </p>
                                        <p><a id="product_url{{ $product->id }}"
                                                href="/chi-tiet-san-pham/{{ $product->id }}" class="btn-view">Xem <i
                                                    class="fas fa-eye"></i></a></p>



                                    </div>
                                </div>
                                <div class="p-text">
                                    <a href="#" class="product-name">
                                        <p>{{ $product->name }}</p>
                                    </a>
                                    <div class="product-price">
                                        @if ($product->discount != null)
                                            <span class="price-initial">{{ number_format($product->price) }} VNĐ</span>
                                            <span
                                                class="price-sale">{{ number_format($product->price - $product->price * ($product->discount / 100)) }}
                                                VNĐ</span>
                                        @else
                                            <span>{{ number_format($product->price) }} VNĐ </span>
                                        @endif


                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{ $products->links() }}
        </div>
    </section>
    {{-- Product Shop Section End --}}
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#slider-range").slider({
                orientation: "horizontal",
                range: true,
                min: {{ $min_price_range }},
                max: {{ $max_price_range }},
                values: [{{ $min_price_range }}, {{ $max_price_range }}],
                step: 100000,
                slide: function(event, ui) {
                    $("#amount_start").val(ui.values[0]).simpleMoneyFormat();
                    $("#amount_end").val(ui.values[1]).simpleMoneyFormat();
                    $("#start_price").val(ui.values[0]);
                    $("#end_price").val(ui.values[1]);
                }
            });
            $("#amount_start").val($("#slider-range").slider("values", 0)).simpleMoneyFormat();
            $("#amount_end").val($("#slider-range").slider("values", 1)).simpleMoneyFormat();
        });
    </script>
@endpush
