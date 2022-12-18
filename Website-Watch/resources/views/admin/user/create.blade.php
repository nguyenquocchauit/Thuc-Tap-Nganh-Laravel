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
                                    User
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
                                    <form method="post" action="admin/user" enctype="multipart/form-data">
                                        @csrf

                                        @if (session('mes'))
                                        <div class="alert alert-warning" role="alert">
                                            {{session('mes')}}
                                        </div>
                                        @endif

                                        <div class="position-relative row form-group">
                                            <label for="id" class="col-md-3 text-md-right col-form-label">Id</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="id" id="id" placeholder="Nhập id" type="text"
                                                    class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="name" id="name" placeholder="Nhập tên" type="text"
                                                    class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="phone"
                                                class="col-md-3 text-md-right col-form-label">Số điện thoại</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="phone_number" id="phone" placeholder="Nhập số điện thoại" type="tel" 
                                                    class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="address"
                                                class="col-md-3 text-md-right col-form-label">Địa chỉ</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="address" id="address" placeholder="Nhập địa chỉ" type="text"
                                                    class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="email"
                                                class="col-md-3 text-md-right col-form-label">Email</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="email" id="email" placeholder="Nhập Email" type="email"
                                                    class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="password"
                                                class="col-md-3 text-md-right col-form-label">Mật khẩu</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input name="password" id="password" placeholder="Nhập mật khẩu" type="password"
                                                    class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="password_confirmation"
                                                class="col-md-3 text-md-right col-form-label">Nhập lại mật khẩu</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input name="password_confirmation" id="password_confirmation" placeholder="Nhập lại mật khẩu" type="password"
                                                    class="form-control" value="">
                                            </div>
                                        </div>


                                        <div class="position-relative row form-group mb-1">
                                            <div class="col-md-9 col-xl-8 offset-md-2">
                                                <a href="./admin/user" class="border-0 btn btn-outline-danger mr-1">
                                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                                        <i class="fa fa-times fa-w-20"></i>
                                                    </span>
                                                    <span>Hủy</span>
                                                </a>

                                                <button type="submit"
                                                    class="btn-shadow btn-hover-shine btn btn-primary">
                                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                                        <i class="fa fa-download fa-w-20"></i>
                                                    </span>
                                                    <span>Thêm</span>
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
