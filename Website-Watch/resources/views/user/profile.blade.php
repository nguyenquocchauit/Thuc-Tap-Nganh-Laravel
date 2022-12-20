@extends('layouts.app')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5 body-profile  ">
        <div class="row">
            <div class="col-md-5 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px" src="{{ asset('images/avt-comment.webp') }}"><span
                        class="font-weight-bold">{{ Auth::user()->name }}</span><span
                        class="text-black-50">{{ Auth::user()->email }}</span><span>
                    </span></div>
            </div>
            <div class="col-md-7 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="text-right"><strong>Cài đặt thông tin cá nhân</strong></h3>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Họ và tên <span
                                    style="color: red">*</span></label><input type="text" class="form-control" id="name-Profile"
                                placeholder="họ và tên" value="{{ Auth::user()->name }}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Số điện thoại <span
                                    style="color: red">*</span></label><input type="text" class="form-control" id="phone-Profile"
                                placeholder="nhập số điện thoại" value="{{ Auth::user()->phone_number }}"></div>
                        <div class="col-md-12"><label class="labels">Địa chỉ</label><input
                                type="text" class="form-control"  id="address-Profile" placeholder="nhập địa chỉ"
                                value="{{ Auth::user()->address }}"></div>
                        <div class="col-md-12"><label class="labels">Email <span style="color: red">*</span></label><input
                                type="text" class="form-control" id="email-Profile" placeholder="nhập email"
                                value="{{ Auth::user()->email }}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Mật khẩu hiện tại <span
                                    style="color: red">*</span></label><input type="password" class="form-control"
                                placeholder="nhập mật khẩu hiện tại" id="pass-Profile" value=""><span onclick="show_hidden_password_profile()"
                                class="changePasword_Profile"><i id="iconProfile" class="fas fa-eye"></i></span></div>
                        <div class="col-md-6"><label class="labels">Mật khẩu mới</label><input type="password"
                                class="form-control" id="checkPass-Profile" value="" placeholder="nhập mật khẩu cần đổi (nếu cần)"><span
                                onclick="confirm_show_hidden_password_profile()" class="changePasword_Profile"><i id="iconCProfile"
                                    class="fas fa-eye"></i></span></div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" id="save-profile-button" type="button">Lưu
                            thông tin</button> <input type="hidden" id="id-Profile" value="{{ Auth::user()->id }}"></div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
@endsection
