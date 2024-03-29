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
                            Xem, <strong>tạo</strong>, sửa, xóa và quản lý.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="create-product" method="post" action="" enctype="multipart/form-data">
                            <div class="position-relative row form-group">
                                <label for="name_product" class="col-md-3 text-md-right col-form-label">Tên sản phẩm<strong style="color: red">*</strong></label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name_product" id="name_product" placeholder="Tên sản phẩm" type="text"
                                        class="form-control" value="">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="brand" class="col-md-3 text-md-right col-form-label">Hãng<strong style="color: red">*</strong></label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="brand_id" id="brand" class="form-control">
                                        <option value="">-- Hãng --</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="product_category_id" class="col-md-3 text-md-right col-form-label">Loại<strong style="color: red">*</strong></label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="product_category_id" id="product_category_id" class="form-control">
                                        <option value="">-- Loại --</option>
                                        <option value="1">
                                            Nam
                                        </option>
                                        <option value="2">
                                            Nữ
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="price_product" class="col-md-3 text-md-right col-form-label">Giá<strong style="color: red">*</strong></label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="price_product" id="price_product" placeholder="Giá" type="text"
                                        class="form-control" value="">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="discount_product" class="col-md-3 text-md-right col-form-label">Giảm giá<strong style="color: red">*</strong></label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="discount_product" id="discount_product" placeholder="Giảm giá"
                                        type="text" class="form-control" value="">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="quantity_product" class="col-md-3 text-md-right col-form-label">Số lượng
                                    kho<strong style="color: red">*</strong></label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="quantity_product" id="quantity_product" placeholder="Số lượng kho"
                                        type="text" class="form-control" value="">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="image_product" class="col-md-3 text-md-right col-form-label">Ảnh<strong style="color: red">*</strong></label>
                                <div class="col-md-9 col-xl-8">
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="image_1" class="file-image">
                                                <img class="w-100" src="{{ 'images/default-image.jpg' }}" alt=""
                                                    id="img-1">
                                            </label>
                                            <input class="image_product" type="file" id="image_1" name="image[]"
                                                data-id="img-1" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_2" class="file-image">
                                                <img class="w-100" src="{{ 'images/default-image.jpg' }}" alt=""
                                                    id="img-2">
                                            </label>
                                            <input class="image_product" type="file" id="image_2" name="image[]"
                                                data-id="img-2" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_3" class="file-image">
                                                <img class="w-100" src="{{ 'images/default-image.jpg' }}" alt=""
                                                    id="img-3">
                                            </label>
                                            <input class="image_product" type="file" id="image_3" name="image[]"
                                                data-id="img-3" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_4" class="file-image">
                                                <img class="w-100" src="{{ 'images/default-image.jpg' }}" alt=""
                                                    id="img-4">
                                            </label>
                                            <input class="image_product" type="file" id="image_4" name="image[]"
                                                data-id="img-4" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_5" class="file-image">
                                                <img class="w-100" src="{{ 'images/default-image.jpg' }}"
                                                    alt="" id="img-5">
                                            </label>
                                            <input class="image_product" type="file" id="image_5" name="image[]"
                                                data-id="img-5" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_6" class="file-image">
                                                <img class="w-100" src="{{ 'images/default-image.jpg' }}"
                                                    alt="" id="img-6">
                                            </label>
                                            <input class="image_product" type="file" id="image_6" name="image[]"
                                                data-id="img-6" style="display:none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="description_product" class="col-md-3 text-md-right col-form-label">Mô
                                    tả<strong style="color: red">*</strong></label>
                                <div class="col-md-9 col-xl-8">
                                    <textarea class="form-control" name="description_product" id="description_product" placeholder="Mô tả">{{ old('description_product') }}</textarea>
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
                                    <button type="button" class="btn-shadow btn-hover-shine btn btn-primary "
                                        id="btn-create-product">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="fa fa-download fa-w-20"></i>
                                        </span>
                                        <span>Tạo</span>
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
