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
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a href="./admin/product" class="nav-link">
                    <span class="btn-icon-wrapper pr-2 opacity-8">
                        <i class="fa fa-arrow-left fa-w-20"></i>
                    </span>
                    <span>Quay lại</span>
                </a>
            </li>

            <li class="nav-item delete">
                <button class="nav-link btn btn-delete-product" type="button" name="btn-delete-product">
                    <span class="btn-icon-wrapper pr-2 opacity-8">
                        <i class="fa fa-trash fa-w-20"></i>
                    </span>
                    <span>Xóa</span>
                    <input type="hidden" name="" value="{{ $product->id }}">
                </button>
            </li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="update-product" method="post" action="" enctype="multipart/form-data">
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
                                        <option value="1" @if ($product->gender == 1) {{ 'selected' }} @endif>
                                            Nam
                                        </option>
                                        <option value="2" @if ($product->gender == 2) {{ 'selected' }} @endif>
                                            Nữ
                                        </option>
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
                                                    src="{{ 'images/images-product/' . $slugGender . '/' . $product->productBrand['slug'] . '/' . $product->image_1 }}"
                                                    alt="" id="img-1">
                                            </label>
                                            <input class="image_product" type="file" id="image_1" name="image[]"
                                                data-id="img-1" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_2" class="file-image">
                                                <img class="w-100"
                                                    src="{{ 'images/images-product/' . $slugGender . '/' . $product->productBrand['slug'] . '/' . $product->image_2 }}"
                                                    alt="" id="img-2">
                                            </label>
                                            <input class="image_product" type="file" id="image_2" name="image[]"
                                                data-id="img-2" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_3" class="file-image">
                                                <img class="w-100"
                                                    src="{{ 'images/images-product/' . $slugGender . '/' . $product->productBrand['slug'] . '/' . $product->image_3 }}"
                                                    alt="" id="img-3">
                                            </label>
                                            <input class="image_product" type="file" id="image_3" name="image[]"
                                                data-id="img-3" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_4" class="file-image">
                                                <img class="w-100"
                                                    src="{{ 'images/images-product/' . $slugGender . '/' . $product->productBrand['slug'] . '/' . $product->image_4 }}"
                                                    alt="" id="img-4">
                                            </label>
                                            <input class="image_product" type="file" id="image_4" name="image[]"
                                                data-id="img-4" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_5" class="file-image">
                                                <img class="w-100"
                                                    src="{{ 'images/images-product/' . $slugGender . '/' . $product->productBrand['slug'] . '/' . $product->image_5 }}"
                                                    alt="" id="img-5">
                                            </label>
                                            <input class="image_product" type="file" id="image_5" name="image[]"
                                                data-id="img-5" style="display:none;">
                                        </div>
                                        <div class="col-2">
                                            <label for="image_6" class="file-image">
                                                <img class="w-100"
                                                    src="{{ 'images/images-product/' . $slugGender . '/' . $product->productBrand['slug'] . '/' . $product->image_6 }}"
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
                                    tả</label>
                                <div class="col-md-9 col-xl-8">
                                    <textarea class="form-control" name="description_product" id="description_product" placeholder="Mô tả">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="email" class="col-md-3 text-md-right col-form-label">Tạo vào ngày</label>
                                <div class="col-md-9 col-xl-8">
                                    <input disabled="" name="created_at" id="created_at" type="text"
                                        class="form-control" value="{{ $product->created_at }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="email" class="col-md-3 text-md-right col-form-label">Cập nhật vào
                                    ngày</label>
                                <div class="col-md-9 col-xl-8">
                                    <input disabled="" name="updated_at" id="updated_at" type="text"
                                        class="form-control" value="{{ $product->update_at }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <button type="button" class="btn-shadow btn-hover-shine btn btn-primary "
                                        id="btn-update-product">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="fa fa-download fa-w-20"></i>
                                        </span>
                                        <span>Lưu</span>
                                        <input type="hidden" name="" value="{{ $product->id }}">
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
