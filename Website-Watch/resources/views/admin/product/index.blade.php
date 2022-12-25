@extends('admin.layout.master')
@section('body')
    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Sản phẩm
                        <div class="page-title-subheading">
                            <strong>Xem</strong>, tạo, sửa, xóa và quản lý.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="./admin/product/create" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Tạo
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                        
                        <form>
                            
                                <div class="row">

                                    <div class="col-3">
                                        <select name="brand" class="form-control">
                                            <option value="0">Tất cả hãng</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}" {{request()->brand==$brand->id?'selected':false}}>{{$brand->id}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-3">
                                        <select name="category" class="form-control">
                                            <option value="0">Tất cả loại</option>
                                            @foreach ($categories as $categories)
                                                <option value="{{$categories->id}}" {{request()->category==$categories->id?'selected':false}}>{{$categories->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <div class="col-4">
                                        <input type="search" name="search" id="search" placeholder="Tên sản phẩm"
                                            class="form-control" value="{{request()->search}}">
                                    </div>
                        
                                    <div class="col-2">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-search"></i>&nbsp;
                                                Tìm
                                            </button>
                                        </span>
                                    </div>   
                        
                                </div>
                        </form>

                        {{-- <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="btn btn-focus">This week</button>
                                <button class="active btn btn-focus">Anytime</button>
                            </div>
                        </div> --}}
                    </div>
                    @include('admin.alert')
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Ảnh</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Giá
                                        <a href="./admin/product?sort-by=price&sort-type={{$sortType}}">
                                            <i class="fas fa-sort"></i>
                                            </a> 
                                    </th>
                                    <th class="text-center">Giảm giá
                                        <a href="./admin/product?sort-by=discount&sort-type={{$sortType}}">
                                            <i class="fas fa-sort"></i>
                                            </a> 
                                    </th>
                                    <th class="text-center">Số lượng
                                        <a href="./admin/product?sort-by=quantity&sort-type={{$sortType}}">
                                            <i class="fas fa-sort"></i>
                                            </a> 
                                    </th>
                                    <th class="text-center">Loại</th>
                                    <th class="text-center">Hãng</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="text-center text-muted">{{ $product->id }}</td>
                                        <td class="text-center image-list-product"><img width="100px" height="100px"
                                            src="{{ asset('images/image_products_home/') }}/{{ $product->productImage['image_1'] }}"
                                            alt=""></td>
                                        <td class="text-center">{{ $product->name }}</td>
                                        <td class="text-center">{{ number_format($product->price) . ' VNĐ' }}</td>
                                        <td class="text-center">{{ $product->discount . '%' }}</td>
                                        <td class="text-center">
                                            <div class="badge badge-success mt-2">
                                                {{ $product->quantity }}
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $product->productGender['name'] }}</td>
                                        <td class="text-center">{{ $product->productBrand['name'] }}</td>
                                        <td class="text-center">
                                            <a href="/admin/product/{{ $product->id }}" data-toggle="tooltip"
                                                title="Chi tiết" data-placement="bottom"
                                                class="btn btn-outline-success border-0 btn-sm">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fas fa-info-circle fa-w-20"></i>
                                                </span>
                                            </a>
                                            <a href="/admin/product/{{ $product->id }}/edit" data-toggle="tooltip"
                                                title="Chỉnh sửa" data-placement="bottom"
                                                class="btn btn-outline-warning border-0 btn-sm">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-edit fa-w-20"></i>
                                                </span>
                                            </a>
                                            <form class="d-inline" action="./admin/product/ {{$product->id}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                    type="submit" data-toggle="tooltip" title="Delete"
                                                    data-placement="bottom"
                                                    onclick="return confirm('Bạn có thực sự muốn xóa sản phẩm này?')">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="fa fa-trash fa-w-20"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block card-footer">
                        {!! $products->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
