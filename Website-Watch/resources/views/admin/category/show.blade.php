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
                                    Loại
                                    <div class="page-title-subheading">
                                        Xem, tạo, sửa, xóa và quản lý.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                        <li class="nav-item">
                            <a href="./admin/category/{{$category->id}}/edit" class="nav-link">
                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                    <i class="fa fa-edit fa-w-20"></i>
                                </span>
                                <span>Edit</span>
                            </a>
                        </li>

                        <li class="nav-item delete">
                            <form action="./admin/category/ {{ $category->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="nav-link btn" type="submit"
                                    onclick="return confirm('Bạn có thực sự muốn xóa mục này?')">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-trash fa-w-20"></i>
                                    </span>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </li>
                    </ul>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body display_data">

                                    <div class="position-relative row form-group">
                                        <label for="name" class="col-md-3 text-md-right col-form-label">
                                            Id
                                        </label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$category->id}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="name" class="col-md-3 text-md-right col-form-label">
                                            Tên
                                        </label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$category->name}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="slug" class="col-md-3 text-md-right col-form-label">
                                            Slug
                                        </label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$category->slug}}</p>
                                        </div>
                                    </div>


                                    <a href="./admin/category" class="btn btn-link">
                                        <span>Quay lại</span>
                                    </a>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Main -->
@endsection