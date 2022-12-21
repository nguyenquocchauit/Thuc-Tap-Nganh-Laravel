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
                        Product
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data"></form>

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên sản phẩm</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="name" id="name-product" placeholder="Tên sản phẩm" type="text"
                                    class="form-control" value="">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="brand_id" class="col-md-3 text-md-right col-form-label">Hãng</label>
                            <div class="col-md-9 col-xl-8">
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">-- Hãng --</option>
                                    <option value=0>
                                        Calvin Klein
                                    </option>
                                    <option value=1>
                                        Diesel
                                    </option>
                                    <option value=2>
                                        Polo
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="product_category_id" class="col-md-3 text-md-right col-form-label">Loại</label>
                            <div class="col-md-9 col-xl-8">
                                <select name="product_category_id" id="product_category_id" class="form-control">
                                    <option value="">-- Loại --</option>
                                    <option value=0>
                                        Men
                                    </option>
                                    <option value=1>
                                        Women
                                    </option>
                                    <option value=2>
                                        Kid
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="price" class="col-md-3 text-md-right col-form-label">Giá</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="price" id="price" placeholder="Price" type="text"
                                    class="form-control" value="">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="discount" class="col-md-3 text-md-right col-form-label">Giảm giá</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="discount" id="discount" placeholder="Discount" type="text"
                                    class="form-control" value="">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="weight" class="col-md-3 text-md-right col-form-label">Số lượng kho</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="weight" id="weight" placeholder="Weight" type="text"
                                    class="form-control" value="">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="description" class="col-md-3 text-md-right col-form-label">Ảnh</label>
                            <div class="col-md-9 col-xl-8">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="file-input-image-1" class="file-image">
                                            <img class="w-100" src="{{ 'images/default-image.jpg' }}" alt="">
                                        </label>
                                        <input class="image-product" type="file" id="file-input-image-1"
                                            style="display:none;">
                                    </div>
                                    <div class="col-2">
                                        <label for="file-input-image-2" class="file-image">
                                            <img class="w-100" src="{{ 'images/default-image.jpg' }}" alt="">
                                        </label>
                                        <input class="image-product" type="file" id="file-input-image-2"
                                            style="display:none;">
                                    </div>
                                    <div class="col-2">
                                        <label for="file-input-image-3" class="file-image">
                                            <img class="w-100" src="{{ 'images/default-image.jpg' }}" alt="">
                                        </label>
                                        <input class="image-product" type="file" id="file-input-image-3"
                                            style="display:none;">
                                    </div>
                                    <div class="col-2">
                                        <label for="file-input-image-4" class="file-image">
                                            <img class="w-100" src="{{ 'images/default-image.jpg' }}" alt="">
                                        </label>
                                        <input class="image-product" type="file" id="file-input-image-4"
                                            style="display:none;">
                                    </div>
                                    <div class="col-2">
                                        <label for="file-input-image-5" class="file-image">
                                            <img class="w-100" src="{{ 'images/default-image.jpg' }}" alt="">
                                        </label>
                                        <input class="image-product" type="file" id="file-input-image-5"
                                            style="display:none;">
                                    </div>
                                    <div class="col-2">
                                        <label for="file-input-image-6" class="file-image">
                                            <img class="w-100" src="{{ 'images/default-image.jpg' }}" alt="">
                                        </label>
                                        <input class="image-product" type="file" id="file-input-image-6"
                                            style="display:none;">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="description" class="col-md-3 text-md-right col-form-label">Mô tả</label>
                            <div class="col-md-9 col-xl-8">
                                <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                <a href="#" class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Hủy</span>
                                </a>

                                <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary " id="btn-create-product">
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
