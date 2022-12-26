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
                            Xem, tạo, <strong>sửa</strong>, xóa và quản lý.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" action="admin/product" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="position-relative row form-group">
                                <label for="name_product" class="col-md-3 text-md-right col-form-label">Tên sản phẩm</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name_product" id="name_product" placeholder="Tên sản phẩm" type="text"
                                        class="form-control" value="{{ $product->name }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="brand_id" class="col-md-3 text-md-right col-form-label">Hãng</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option value="null">-- Hãng --</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                @if ($brand->id == $product->brand) {{ 'selected' }} @endif>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="product_category_id" class="col-md-3 text-md-right col-form-label">Loại</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="product_category_id" id="product_category_id" class="form-control">
                                        <option value="null">-- Loại --</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}"
                                                @if ($gender->id == $product->gender) {{ 'selected' }} @endif>
                                                {{ $gender->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="price_product" class="col-md-3 text-md-right col-form-label">Giá</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="price_product" id="price_product" placeholder="Giá" type="text"
                                        class="form-control" value="{{ number_format($product->price) . ' VNĐ' }}">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="discount_product" class="col-md-3 text-md-right col-form-label">Giảm giá</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="discount_product" id="discount_product" placeholder="Giảm giá"
                                        type="text" class="form-control" value="{{ $product->discount . '%' }}">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="quantity_product" class="col-md-3 text-md-right col-form-label">Số lượng
                                    kho</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="quantity_product" id="quantity_product" placeholder="Số lượng kho"
                                        type="text" class="form-control" value="{{ $product->quantity }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="image_product" class="col-md-3 text-md-right col-form-label">Ảnh</label>
                                <div class="col-md-9 col-xl-8">
                                    {{-- lấy path image thông qua slug brand và gender của product --}}
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="image_1" class="file-image">
                                                <img class="w-100"
                                                    src="{{ 'images/images-product/' . $product->productGender['slug'] . '/' . $product->productBrand['slug'] . '/' . $product->productImage['image_1'] }}"
                                                    alt="" id="img-1">
                                            </label>
                                            <input class="image_product" type="file" id="image_1" name="image_1"
                                                data-id="img-1" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_2" class="file-image">
                                                <img class="w-100"
                                                    src="{{ 'images/images-product/' . $product->productGender['slug'] . '/' . $product->productBrand['slug'] . '/' . $product->productImage['image_2'] }}"
                                                    alt="" id="img-2">
                                            </label>
                                            <input class="image_product" type="file" id="image_2" name="image_2"
                                                data-id="img-2" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_3" class="file-image">
                                                <img class="w-100"
                                                    src="{{ 'images/images-product/' . $product->productGender['slug'] . '/' . $product->productBrand['slug'] . '/' . $product->productImage['image_3'] }}"
                                                    alt="" id="img-3">
                                            </label>
                                            <input class="image_product" type="file" id="image_3" name="image_3"
                                                data-id="img-3" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_4" class="file-image">
                                                <img class="w-100"
                                                    src="{{ 'images/images-product/' . $product->productGender['slug'] . '/' . $product->productBrand['slug'] . '/' . $product->productImage['image_4'] }}"
                                                    alt="" id="img-4">
                                            </label>
                                            <input class="image_product" type="file" id="image_4" name="image_4"
                                                data-id="img-4" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_5" class="file-image">
                                                <img class="w-100"
                                                    src="{{ 'images/images-product/' . $product->productGender['slug'] . '/' . $product->productBrand['slug'] . '/' . $product->productImage['image_5'] }}"
                                                    alt="" id="img-5">
                                            </label>
                                            <input class="image_product" type="file" id="image_5" name="image_5"
                                                data-id="img-5" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_6" class="file-image">
                                                <img class="w-100"
                                                    src="{{ 'images/images-product/' . $product->productGender['slug'] . '/' . $product->productBrand['slug'] . '/' . $product->productImage['image_6'] }}"
                                                    alt="" id="img-6">
                                            </label>
                                            <input class="image_product" type="file" id="image_6" name="image_6"
                                                data-id="img-6" style="display:none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="description_product" class="col-md-3 text-md-right col-form-label">Mô
                                    tả</label>
                                <div class="col-md-9 col-xl-8">
                                    <textarea class="form-control" name="description_product" id="description_product" placeholder="Mô tả">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="./admin/product" class="border-0 btn btn-outline-danger mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="fa fa-times fa-w-20"></i>
                                        </span>
                                        <span>Hủy</span>
                                    </a>
                                    <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary "
                                        id="btn-create_product">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="fa fa-download fa-w-20"></i>
                                        </span>
                                        <span>Lưu</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
