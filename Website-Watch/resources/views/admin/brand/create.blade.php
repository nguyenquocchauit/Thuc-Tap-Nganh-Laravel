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
                                        Xem, tạo, sửa, xóa và quản lý.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <form method="post" action="admin/brand" enctype="multipart/form-data">
                                        @csrf
                                        @include('admin.alert')
                                        
                                        <div class="position-relative row form-group">
                                            <label for="id" class="col-md-3 text-md-right col-form-label">Id</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input  name="id" id="id" placeholder="Nhập id" type="text"
                                                    class="form-control" value="{{old('id')}}">
                                                    <span style="color: red">
                                                        @error('id')
                                                            {{$message}}
                                                        @enderror
                                                    </span>
                                            </div>
                                        </div>
                                        
                                        <div class="position-relative row form-group">
                                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input  name="name" id="name" placeholder="Nhập tên" type="text"
                                                    class="form-control" value="{{old('name')}}">
                                                    <span style="color: red">
                                                        @error('name')
                                                            {{$message}}
                                                        @enderror
                                                    </span>
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="slug" class="col-md-3 text-md-right col-form-label">Slug</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input  name="slug" id="slug" placeholder="Nhập slug" type="text"
                                                    class="form-control" value="{{old('slug')}}">
                                                    <span style="color: red">
                                                        @error('slug')
                                                            {{$message}}
                                                        @enderror
                                                    </span>
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

                                                <button type="submit"
                                                    class="btn-shadow btn-hover-shine btn btn-primary">
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