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
                        Hãng
                        <div class="page-title-subheading">
                            Xem, tạo, <strong>sửa</strong>, xóa và quản lý.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a href="./admin/brand" class="nav-link">
                    <span class="btn-icon-wrapper pr-2 opacity-8">
                        <i class="fa fa-arrow-left fa-w-20"></i>
                    </span>
                    <span>Quay lại</span>
                </a>
            </li>
            <li class="nav-item delete">
                <button class="nav-link btn btn-delete-product btn-delete-brand" type="button">
                    <span class="btn-icon-wrapper pr-2 opacity-8">
                        <i class="fa fa-trash fa-w-20"></i>
                    </span>
                    <span>Xóa</span>
                    <input type="hidden" name="" value="{{ $brand->id }}" id="id-brand">
                </button>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="update-brand" method="post" action="" enctype="multipart/form-data">
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Tên</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name" id="name" placeholder="Name" type="text"
                                        class="form-control" value="{{ $brand->name }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="slug" class="col-md-3 text-md-right col-form-label">Slug</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="slug" id="slug" placeholder="Nhập slug" type="text"
                                        class="form-control" value="{{ $brand->slug }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <button type="button" class="btn-shadow btn-hover-shine btn btn-primary "
                                        id="btn-update-brand">
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
