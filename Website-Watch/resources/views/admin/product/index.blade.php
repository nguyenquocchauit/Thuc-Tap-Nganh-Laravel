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
                            Xem, tạo, sửa, xóa và <strong>quản lý.</strong>
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
                                            <option value="{{ $brand->id }}"
                                                {{ request()->brand == $brand->id ? 'selected' : false }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-3">
                                    <select name="category" class="form-control">
                                        <option value="0">Tất cả loại</option>
                                        <option value="1" {{ request()->category == 1 ? 'selected' : false }}>
                                            Nam
                                        </option>
                                        <option value="2" {{ request()->category == 2 ? 'selected' : false }}>
                                            Nữ
                                        </option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <input type="search" name="search" id="search" placeholder="Tên sản phẩm"
                                        class="form-control" value="{{ request()->search }}">
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


                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Ảnh</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Giá
                                        <a href="./admin/product?brand={{ request()->brand }}&category={{ request()->category }}&search={{ request()->search }}&sort-by=price&sort-type={{ $sortType }}">
                                            <i class="fas fa-sort"></i>
                                        </a>
                                    </th>
                                    <th class="text-center">Giảm giá
                                        <a href="./admin/product?brand={{ request()->brand }}&category={{ request()->category }}&search={{ request()->search }}&sort-by=discount&sort-type={{ $sortType }}">
                                            <i class="fas fa-sort"></i>
                                        </a>
                                    </th>
                                    <th class="text-center">Số lượng
                                        <a href="./admin/product?brand={{ request()->brand }}&category={{ request()->category }}&search={{ request()->search }}&sort-by=quantity&sort-type={{ $sortType }}">
                                            <i class="fas fa-sort"></i>
                                        </a>
                                    </th>
                                    <th class="text-center">Loại</th>
                                    <th class="text-center">Hãng</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $key=> $product)
                                    <tr>
                                        <td class="text-center text-muted" >{{ $key+1 }}</td>
                                        <td class="text-center text-muted"style="opacity: 0.8;">{{ $product->id }}</td>
                                        <td class="text-center image-list-product"><img width="100px" height="100px"
                                                src="{{ asset('images/image_products_home/') }}/{{ $product->productImage['image_1'] }}"
                                                alt=""></td>
                                        <td class="text-center">{{ $product->name }}</td>
                                        <td class="text-center">{{ number_format($product->price) . ' VNĐ' }}</td>
                                        <td class="text-center">{{ $product->discount . '%' }}</td>
                                        <td class="text-center">
                                            @if ($product->quantity > 0)
                                                <div class="badge badge-success mt-2">
                                                    {{ $product->quantity }}
                                                </div>
                                            @else
                                                <div class="badge badge-danger mt-2">
                                                    Hết hàng
                                                </div>
                                            @endif

                                        </td>
                                        @if ($product->gender == 1)
                                            <td class="text-center">Nam</td>
                                        @else
                                            <td class="text-center">Nữ</td>
                                        @endif
                                        <td class="text-center">{{ $product->productBrand['name'] }}</td>
                                        <td class="text-center">
                                            <a href="/chi-tiet-san-pham/{{ $product->id }}" data-toggle="tooltip"
                                                title="Xem tại trang bán hàng" data-placement="bottom"
                                                class="btn btn-outline-success border-0 btn-sm" target="_blank">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fas fa-eye fa-w-20"></i>
                                                </span>
                                            </a>
                                            <a href="/admin/product/{{ $product->id }}/edit" data-toggle="tooltip"
                                                title="Chỉnh sửa" data-placement="bottom"
                                                class="btn btn-outline-warning border-0 btn-sm">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-edit fa-w-20"></i>
                                                </span>
                                            </a>
                                            <button
                                                class="btn btn-hover-shine btn-outline-danger border-0 btn-sm btn-delete-product"
                                                name="btn-delete-product" type="submit" data-toggle="tooltip"
                                                title="Delete" data-placement="bottom">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-trash fa-w-20"></i>
                                                </span>
                                                <input type="hidden" name="" value="{{ $product->id }}">
                                            </button>
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
