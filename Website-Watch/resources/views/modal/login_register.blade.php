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
                <button href="#" class="btn btn-primary btn-block mt-3 w-100" id="btn-login-user">Đăng
                    Nhập</button>
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
                <form id="register-customer" method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-4">
                            <label class="form-label">
                                <h5>Họ và Tên <strong style="color: red">*</strong></h5>
                            </label>
                            <input class="w-100 form-control" type="text" placeholder="Họ và tên" name="name"
                                id="nameRegister">
                        </div>
                        <div class="col-4">
                            <label class="form-label">
                                <h5>Email <strong style="color: red">*</strong></h5>
                            </label>
                            <input class="w-100 form-control" type="text" placeholder="Email" name="email"
                                id="emailRegister">
                        </div>
                        <div class="col-4">
                            <label class="form-label">
                                <h5>Số di động <strong style="color: red">*</strong></h5>
                            </label>
                            <input class="w-100 form-control" type="text" placeholder="Số di động" name="phone_number"
                                id="phoneRegister">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" style="padding-top: 10px;">
                                <h5>Địa chỉ <strong style="color: red">*</strong></h5>
                            </label>
                            <select class="form-control form-select form-select-sm mb-3" id="city"
                                style="padding:15px" aria-label=".form-select-sm">
                                <option value="" selected>Chọn tỉnh thành</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="w-100 form-control form-select form-select-sm" id="district"
                                style="margin-top: 50px;padding: 15px;" aria-label=".form-select-sm">
                                <option value="" selected>Chọn quận huyện</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <select class="form-control form-select form-select-sm" id="ward"
                                style="padding: 15px;" aria-label=".form-select-sm">
                                <option value="" selected>Chọn phường xã</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <input class="w-100 form-control" type="text" placeholder="Địa chỉ" name="address"
                                id="addressRegister">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" style="padding-top: 10px;">
                                <h5>Mật khẩu <strong style="color: red">*</strong></h5>
                            </label>
                            <input class="w-100 form-control" type="password" placeholder="Mật khẩu" name="password"
                                id="passRegister">
                            <span onclick="show_hidden_password()" class="changePasword_Singup"><i id="iconRegister"
                                    class="fas fa-eye"></i></span>
                        </div>
                        <div class="col-6">
                            <label class="form-label" style="padding-top: 10px;">
                                <h5>Nhập lại mật khẩu <strong style="color: red">*</strong></h5>
                            </label>
                            <input class="w-100 form-control" type="password" placeholder="Nhập lại mật khẩu"
                                name="password_confirmation" id="checkPassRegister">
                            <span onclick="confirm_show_hidden_password()" class="changePasword_Singup"><i
                                    id="iconCRegister" class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button href="#" class="btn btn-primary btn-block mt-3 w-100 " id="btn-register-user">Đăng
                    Ký</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function(result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Id);
        }
        citis.onchange = function() {
            district.length = 1;
            ward.length = 1;
            if (this.value != "") {
                const result = data.filter(n => n.Id === this.value);

                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Id);
                }
            }
        };
        district.onchange = function() {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Id === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Id);
                }
            }
        };
    }
</script>
