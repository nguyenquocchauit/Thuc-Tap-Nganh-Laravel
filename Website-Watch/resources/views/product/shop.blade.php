@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/shop.css') }}" />
    {{-- Breadcrumb Section Begin --}}
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Breadcrumb Section End --}}

    {{-- Product Shop Section Begin --}}
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 products-sidebar-filter">
                    <form action="">
                        <div class="filter-wiget">
                            <h4 class="fw-title">Loại</h4>
                            <ul class="filter-categories">
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('shop-index') }}/{{ ucfirst(trans($category->slug)) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
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
                                <input type="hidden" name="start_price" id="start_price"
                                    value="{{ old('start_price') }}">
                                <input type="hidden" name="end_price" id="end_price" value="{{ old('end_price') }}">

                                <input type="submit" name="filter_price" class="filter-btn" value="Lọc">
                            </form>
                        </div>
                    </form>
                    <div class="brands-wishlist">
                        <h4 class="brand-title">Sản phẩm yêu thích</h4>
                        <div class="brands-name"></div>

                        <div id="row_wishlist" class="row">

                        </div>
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
                                        <option value="15" {{ request('show') == '15' ? 'selected' : '' }}>Hiển thị: 15
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

                                        <button class="btn-wishlist"  id="{{$product->id}}" onclick="add_wishlist(this.id);">
                                            <i class="fa fa-heart"></i>
                                        </button>
                                        
                                    <div class="quick-view-controller" style="justify-content: center;">
                                        <p class="product-item-desc-button-submit">
                                            <a class="btn-cart add-to-cart">
                                                <i class="fas fa-cart-plus" style="color:black "></i>
                                            </a>
                                            <input type="hidden"  name="productID" class="productID"
                                                value="{{ $product->id }}">
                                            <input type="hidden" id="product_name{{$product->id}}" name="productName" class="productName"
                                                value="{{ $product->name }}">
                                            <input type="hidden" id="product_price{{$product->id}}" name="productName" class="productName"
                                                value="{{($product->discount != null) ? number_format($product->price - $product->price * ($product->discount / 100)) : number_format($product->price) }} VNĐ">    
                                            <input type="hidden" id="product_image{{$product->id}}" 
                                            src="{{URL::to('/images/image_products_home/'.$product->productImage['image_1'])}}" name="productImage" class="productImage"
                                                value="{{ $product->productImage['image_1'] }}">
                                        </p>
                                        <p><a id="product_url{{$product->id}}" href="/chi-tiet-san-pham/{{ $product->id }}" class="btn-view">Xem <i
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
    function view() {
        if(localStorage.getItem('data')!= null) {
            var data = JSON.parse(localStorage.getItem('data'));
            data.reverse();

            document.getElementById('row_wishlist').style.overflow = 'scroll';
            document.getElementById('row_wishlist').style.height = '500px';

            for(i=0; i<data.length; i++) {
                var id = data[i].id;
                var name = data[i].name;
                var price = data[i].price;
                var image = data[i].image;
                var url = data[i].url;
                $("#row_wishlist").append('<div class="row" style="margin: 10px 0"><div class="col-md-4"><img src="'+image+'" width="100%"></div><div class="col-md-8" info_wishlist><p>'+name+'</p><p style="color:#fe980f">'+price+'</p><a class="btn btn-success"  href="'+url+'">Đặt hàng</a><a class="btn btn-danger btn-xs delete_wishlist" data-id="'+id+'" style="margin-top:0">Xóa</a></div></div>');
            }
        }
        $(document).on('click','.delete_wishlist',function(event){
                event.preventDefault(); // những hành động mặc định của sự kiện sẽ k xảy ra
                var id = $(this).data('id');
                
                // console.log(localStorage.getItem('data'));
                if (localStorage.getItem('data') != null) {
                    var data = JSON.parse(localStorage.getItem('data'));
                    if (data.length) {
                            for (i = 0; i < data.length; i++) {
                                if (data[i].id == id) {
                                data.splice(i,1); //xóa phần tử khỏi mảng, tham số thứ 2 là 1 phần tử
                            }
                        }
                    }
                    
                    localStorage.setItem('data',JSON.stringify(data));  //chuyển obj->string
                    alert('Xóa thành công');
                    window.location.reload();
                }
            });   
    }
    view();
    
    function add_wishlist(clicked_id) {
        var id = clicked_id;
        var name = document.getElementById('product_name'+id).value;
        var price = document.getElementById('product_price'+id).value;
        var image = document.getElementById('product_image'+id).src;
        var url = document.getElementById('product_url'+id).href;
        var newItem = {
            'url' : url,
            'id' : id,
            'name' : name,
            'price' : price,
            'image' : image
        }
        if(localStorage.getItem('data') == null ) {
            localStorage.setItem('data', '[]');
        }
        var old_data = JSON.parse(localStorage.getItem('data'));

        

        var matches = $.grep(old_data, function(obj) {
            return obj.id == id;
        })

        if(matches.length) {
            alert('Sản phẩm đã thêm vào yêu thích, nên không thể thêm nữa');
        } else {
            old_data.push(newItem);
            $("#row_wishlist").append('<div class="row" style="margin: 10px 0"><div class="col-md-4"><img src="'+newItem.image+'" width="100%"></div><div class="col-md-8" info_wishlist><p>'+newItem.name+'</p><p style="color:#fe980f">'+newItem.price+'</p><a class="btn btn-success"  href="'+newItem.url+'">Đặt hàng</a><a class="btn btn-danger btn-xs delete_wishlist" data-id="'+newItem.id+'" style="margin-top:0">Xóa</a></div></div>');
        }
        $(document).on('click','.delete_wishlist',function(event){
                event.preventDefault(); // những hành động mặc định của sự kiện sẽ k xảy ra
                var id = $(this).data('id');
                
                // console.log(localStorage.getItem('data'));
                if (localStorage.getItem('data') != null) {
                    var data = JSON.parse(localStorage.getItem('data'));
                    if (data.length) {
                                if (data[i].id == id) {
                                data.splice(i,1); //xóa phần tử khỏi mảng, tham số thứ 2 là 1 phần tử
                            }
                    }
                    
                    localStorage.setItem('data',JSON.stringify(data));  //chuyển obj->string
                    // alert('Xóa thành công');
                    window.location.reload();
                }
            });
        localStorage.setItem('data', JSON.stringify(old_data));
    }    
</script>
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
