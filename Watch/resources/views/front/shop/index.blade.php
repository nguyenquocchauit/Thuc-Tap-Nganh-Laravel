@extends('layouts.app')
@section('content')

    {{-- Breadcrumb Section Begin --}}
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <div class="col-lg-2 col-md-6 col-sm-8 order-2 order-lg-1 products-sidebar-filter">
                    <form action="shop">
                        <div class="filter-wiget">
                            <h4 class="fw-title">Categories</h4>
                            <ul class="filter-categories">
                                @foreach ($categories as $category)
                                    <li><a href="{{route('shop-index')}}/{{ $category->name }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="filter-wiget">
                            <h4 class="fw-title">Brand</h4>
                            <div class="fw-brand-check">
                                @foreach ($brands as $brand)
                                <div class="bc-item">
                                    <label for="bc-{{ $brand->id }}">
                                        {{ $brand->name }}
                                        <input type="checkbox"
                                        {{ (request("brand")[$brand->id] ?? '') == 'on' ? 'checked' : '' }}
                                        id="bc-{{$brand->id}}"
                                        name="brand[{{ $brand->id }}]"  
                                        onchange="this.form.submit();">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="filter-wiget">
                            <h4 class="fw-title">Price</h4>
                            <label for="amount">Lọc theo giá</label>
                            <form>
                                <div id="slider-range">
                                </div>
                                <div class="slider-range">
                                    <p>Min<input type="text" id="amount_start" readonly style="border:0; color:#f6931f; font-weight:bold;"></p>
                                    <p>Max<input type="text" id="amount_end" readonly style="border:0; color:#f6931f; font-weight:bold;"></p>
                                </div>
                                <input type="hidden" name="start_price" id="start_price" value="{{old('min_price_range')}}">
                                <input type="hidden" name="end_price" id="end_price" value="{{old('max_price_range')}}">
                                
                                <input type="submit" name="filter_price" class="filter-btn" value="Filter"> 
                            </form>
                        </div>
                    </form>
                    
                </div>
                <div class="col-lg-10 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                                <form action="">
                                    <div class="select-option">
                                        <select class="sorting" name="sort_by" onchange="this.form.submit();">
                                            <option value="latest" 
                                            {{request('sort_by') == 'latest' ? 'selected' : '' }}>Sorting: Latest</option>
                                            <option value="oldest"
                                            {{request('sort_by') == 'oldest' ? 'selected' : '' }}>Sorting: Oldest</option>
                                            <option value="name-ascending"
                                            {{request('sort_by') == 'name-ascending' ? 'selected' : '' }}>Sorting: A-Z</option>
                                            <option value="name-descending"
                                            {{request('sort_by') == 'name-descending' ? 'selected' : '' }}>Sorting: Z-A</option>
                                            <option value="price-ascending"
                                            {{request('sort_by') == 'price-ascending' ? 'selected' : '' }}>Sorting: Price Ascending</option>
                                            <option value="price-descending"
                                            {{request('sort_by') == 'price-descending' ? 'selected' : '' }}>Sorting: Price Decrease</option>
                                        </select>
                                        <select class="p-show" name="show" onchange="this.form.submit();">
                                            <option value="6" 
                                            {{request('show') == '6' ? 'selected' : '' }}>Show: 6</option>
                                            <option value="9"
                                            {{request('show') == '9' ? 'selected' : '' }}>Show: 9</option>
                                            <option value="15"
                                            {{request('show') == '15' ? 'selected' : '' }}>Show: 15</option>
                                        </select>
                                    </div>
                                </form>
                                <div class="col-lg-7 col-md-7">
                                    {{-- @if (session('success')) 
                                        <div class="alert alert-success" role="alert">
                                                <p>Tìm thấy {{count($products)}} sản phẩm</p>
                                        </div>
                                    @endif

                                    @if (session('error')) 
                                        <div class="alert alert-warning" role="alert">
                                            <p>Không tìm thấy phù hợp kết quả tìm kiếm của bạn</p>
                                        </div>
                                    @endif --}}
                                </div>
                            
                            <div class="col-lg-5 col-md-5 text-right">

                            </div>
                        </div>
                    </div>
                    <ul class="product-list">
                        @foreach ($products as $product)
                        <li>
                            <div class="product">
                                <a href="#" class="product-image">
                                <img src="/images/image_products_home/{{$product->productImage['image_1'] }}" alt="Product">
                                </a>
                                @if ($product->discount != null)

                                <div class="sale pp-sale">{{$product->discount}}%</div>
                                @endif
                                
                                <div class="icon-heart">
                                    <i class="fa fa-heart"></i>
                                </div>
                                <div class="quick-view-controller">
                                    <p><a href="#" class="btn-cart"><i class="fas fa-shopping-cart"></i></a></p>
                                    <p><a href="#" class="btn-view">Quick View</a></p>
                                    <p><a href="#" class="btn-random"><i class="fa fa-random"></i></a></p>
                                </div>
                            </div>
                            <div class="p-text">
                                <a href="#"  class="product-name">
                                    <p>{{$product->name}}</p>
                                </a>
                                <div class="product-price">
                                    @if ($product->discount != null)
                                    <span class="price-sale">{{number_format($product->price-($product->price*($product->discount/100)))}} đ</span> 
                                    <span class="price-initial">{{number_format($product->price) }} đ</span>
                                    @else
                                        <span>{{number_format($product->price)}} đ </span>
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
    
    $( function() {
      $( "#slider-range" ).slider({
        orientation: "horizontal",
        range: true,
        min: {{$min_price_range}},
        max: {{$max_price_range}},
        values: [ {{$min_price_range}},  {{$max_price_range}} ],
        step:100000,
        slide: function( event, ui ) {
            $( "#amount_start" ).val(  ui.values[ 0 ]).simpleMoneyFormat();
            $( "#amount_end" ).val(ui.values[ 1 ]).simpleMoneyFormat();
            $( "#start_price" ).val(  ui.values[ 0 ]);
            $( "#end_price" ).val( ui.values[ 1 ] );
        }
      });
      $( "#amount_start" ).val( $( "#slider-range" ).slider( "values", 0 )).simpleMoneyFormat();
      $( "#amount_end" ).val( $( "#slider-range" ).slider( "values", 1 )).simpleMoneyFormat();
    } );

</script>


    
@endpush