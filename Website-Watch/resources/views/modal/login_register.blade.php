<!-- Modal -->
<!-- Modal-Login -->

<div class="modal fade text-center" id="login" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #d5d5d5">
            <div class="modal-header mx-auto">
                <h5 class="modal-title" id="staticBackdropLabel">Đăng Nhập</h5>
                <button type="button" class="btn-close btn-close-login" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form">
                    <div>
                        <label class="form-label float-start">
                            <h5>Tên đăng nhập <strong style="color: red">*</strong></h5>
                        </label>
                        <input type="text" placeholder="Email" id="usernameLogin" name="userName"
                            class="input w-100 form-control">
                    </div>
                    <div>
                        <label class="form-label float-start">
                            <h5>Mật khẩu <strong style="color: red">*</strong></h5>
                        </label>
                        <input type="password" placeholder="Mật khẩu" id="passwordLogin" name="passWord"
                            class="input w-100 form-control ">
                        <span onclick="show_hidden_password_login()" class="changePasword"><i id="iconLogin"
                                class="fas fa-eye"></i></span>
                    </div>
                    <div class="forgetPass">
                        <a href="#" data-bs-target="#myModal_Forgotten_password" data-bs-toggle="modal"
                            data-bs-dismiss="modal">Quên mật khẩu?</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button href="#" class="btn btn-primary btn-block mt-3 w-100" id="btn-login-user">Đăng Nhập</button>
                <p>Chưa có tài khoản? <a href="#" style="text-decoration: none;" data-bs-target="#signup"
                        data-bs-toggle="modal" data-bs-dismiss="modal">Đăng Ký Ngay</a></p>
                <button type="button" class="btn btn-block mt-3 w-100" style="background: gray;"
                    onclick="location.href='/admin/login';">Đăng nhập quản trị
                    viên</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal-SignUp -->

<div class="modal fade" id="signup" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content" style="background-color: #d5d5d5">
            <div class="modal-header mx-auto">
                <h5 class="modal-title" id="staticBackdropLabel">Đăng Ký</h5>
                <button type="button" class="btn-close btn-close-signup" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">
                                <h5>Họ và Tên <strong style="color: red">*</strong></h5>
                            </label>
                            <input class="w-100 form-control" type="text" placeholder="Họ và tên" name="nameRegister"
                                id="nameRegister">
                        </div>
                        <div class="col-6">
                            <label class="form-label">
                                <h5>Email <strong style="color: red">*</strong></h5>
                            </label>
                            <input class="w-100 form-control" type="text" placeholder="Email" name="emailRegister"
                                id="emailRegister">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" style="padding-top: 10px;">
                                <h5>Số di động <strong style="color: red">*</strong></h5>
                            </label>
                            <input class="w-100 form-control" type="text" placeholder="Số di động" name="phone"
                                id="phoneRegister">
                        </div>
                        <div class="col-6">
                            <label class="form-label" style="padding-top: 10px;">
                                <h5>Địa chỉ</h5>
                            </label>
                            <input class="w-100 form-control" type="text" placeholder="Địa chỉ"
                                name="address" id="addressRegister">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" style="padding-top: 10px;">
                                <h5>Mật khẩu <strong style="color: red">*</strong></h5>
                            </label>
                            <input class="w-100 form-control" type="password"
                                placeholder="Mật khẩu" name="pass" id="passRegister">
                            <span onclick="show_hidden_password()" class="changePasword_Singup"><i id="iconRegister"
                                    class="fas fa-eye"></i></span>
                        </div>
                        <div class="col-6">
                            <label class="form-label" style="padding-top: 10px;">
                                <h5>Nhập lại mật khẩu <strong style="color: red">*</strong></h5>
                            </label>
                            <input class="w-100 form-control" type="password"
                                placeholder="Nhập lại mật khẩu" name="checkPass" id="checkPassRegister">
                            <span onclick="confirm_show_hidden_password()" class="changePasword_Singup"><i
                                    id="iconCRegister" class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button href="#" class="btn btn-primary btn-block mt-3 w-100 " id="btn-register-user">Đăng Ký</button>
                <p>Đã có tài khoản? <a href="#" style="text-decoration: none;" data-bs-target="#login"
                        data-bs-toggle="modal" data-bs-dismiss="modal">Đăng Nhập Ngay</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal-Forgotten-password -->
<div class="modal fade" id="myModal_Forgotten_password" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #d5d5d5">
            <div class="modal-header mx-auto">
                <h5 class="modal-title" id="staticBackdropLabel">Khôi phục mật khẩu</h5>
                <button type="button" class="btn-close btn-close-forget" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form">
                    <div>
                        <label class="form-label">
                            <h5>Tên đăng nhập</h5>
                        </label>
                        <input class="w-100 form-control" type="text" placeholder="Tên đăng nhập">
                    </div>
                    <div>
                        <label class="form-label" style="padding-top: 10px;">
                            <h5>Số di động hoặc Email</h5>
                        </label>
                        <input class="w-100 form-control" type="text" placeholder="Số di động hoặc Email">
                    </div>
                    <div>
                        Liên hệ Page Shop <a href="https://www.facebook.com/NguyenQuocChau.NhaTrang"
                            style="text-decoration: none;">Tại đây</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p>Đã có tài khoản? <a href="#" style="text-decoration: none;" data-bs-target="#login"
                        data-bs-toggle="modal" data-bs-dismiss="modal">Đăng Nhập Ngay</a>
            </div>
        </div>
    </div>
</div>

