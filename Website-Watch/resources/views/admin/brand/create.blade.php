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
                        <form id="create-brand" method="post" action="" enctype="multipart/form-data">
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Tên<strong
                                        style="color: red">*</strong></label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name" id="name" placeholder="Nhập tên (Nguyễn Quốc Châu)" type="text"
                                        class="form-control" value="">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="slug" class="col-md-3 text-md-right col-form-label">Slug</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="slug" id="slug" placeholder="Nhập slug (quoc-chau)" type="text"
                                        class="form-control" value="">
                                </div>
                            </div>
                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="./admin/brand" class="border-0 btn btn-outline-danger mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="fa fa-times fa-w-20"></i>
                                        </span>
                                        <span>Hủy</span>
                                    </a>
                                    <button type="button" class="btn-shadow btn-hover-shine btn btn-primary " id="btn-create-brand">
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
