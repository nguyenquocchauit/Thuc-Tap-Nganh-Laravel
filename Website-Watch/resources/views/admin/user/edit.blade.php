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
                                    Người dùng
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
                                    <form method="post" action="/admin/user/ {{$user->id}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            @include('admin.alert')

                                            <div class="position-relative row form-group">
                                                <label for="id" class="col-md-3 text-md-right col-form-label"></label>
                                                <div class="col-md-9 col-xl-8">
                                                    <input  name="id" id="id" placeholder="Nhập id" type="hidden"
                                                        class="form-control" value="{{$user->id}}">
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
                                                        class="form-control" value="{{$user->name}}">
                                                        <span style="color: red">
                                                            @error('name')
                                                                {{$message}}
                                                            @enderror
                                                        </span>
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group">
                                                <label for="phone"
                                                    class="col-md-3 text-md-right col-form-label">Số điện thoại</label>
                                                <div class="col-md-9 col-xl-8">
                                                    <input  name="phone_number" id="phone" placeholder="Nhập số điện thoại" type="tel"
                                                        class="form-control" value="{{$user->phone_number}}">
                                                        <span style="color: red">
                                                            @error('phone_number')
                                                                {{$message}}
                                                            @enderror
                                                        </span>
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group">
                                                <label for="address"
                                                    class="col-md-3 text-md-right col-form-label">Địa chỉ</label>
                                                <div class="col-md-9 col-xl-8">
                                                    <input  name="address" id="address" placeholder="Nhập địa chỉ" type="text"
                                                        class="form-control" value="{{$user->address}}">
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group">
                                                <label for="email"
                                                    class="col-md-3 text-md-right col-form-label">Email</label>
                                                <div class="col-md-9 col-xl-8">
                                                    <input  name="email" id="email" placeholder="Nhập Email" type="email"
                                                        class="form-control" value="{{$user->email}}">
                                                        <span style="color: red">
                                                            @error('email')
                                                                {{$message}}
                                                            @enderror
                                                        </span>
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group">
                                                <label for="password"
                                                    class="col-md-3 text-md-right col-form-label">Mật khẩu</label>
                                                <div class="col-md-9 col-xl-8">
                                                    <input name="password" id="password" placeholder="Nhập mật khẩu" type="password"
                                                        class="form-control" value="">
                                                        <span style="color: red">
                                                            @error('password')
                                                                {{$message}}
                                                            @enderror
                                                        </span>
                                                </div>
                                            </div>


                                            <div class="position-relative row form-group">
                                                <label for="role_user"
                                                    class="col-md-3 text-md-right col-form-label">Vai trò</label>
                                                <div class="col-md-9 col-xl-8">
                                                    <select name="role" id="role_user" class="form-control">
                                                        <option value="">-- Vai trò --</option>
                                                        @foreach ($roles as $role)
                                                             <option
                                                                    value="{{$role->id}}" @selected(old('role') == $role->id) >
                                                                @if ($role->type == 0)
                                                                    <span>người dùng</span>
                                                                @else
                                                                    <span>quản trị viên</span>
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span style="color: red">
                                                        @error('role')
                                                            {{$message}}
                                                        @enderror
                                                    </span>
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
