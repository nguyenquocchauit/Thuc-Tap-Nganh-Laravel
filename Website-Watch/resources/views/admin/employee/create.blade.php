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
                        Nhân viên
                        <div class="page-title-subheading">
                            Xem, <strong>tạo</strong>, sửa và xóa.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="create-employee" method="post" action="" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-md-10">
                                    <div class="position-relative row form-group">
                                        <label for="name" class="col-md-3 text-md-right col-form-label">Tên<strong
                                                style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="name" id="name" placeholder="Nhập tên" type="text"
                                                class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="position"
                                            class="col-md-3 text-md-right col-form-label">Loại<strong
                                                style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <select name="role" id="position"
                                                class="form-control">
                                                <option value="">Chọn chức vụ</option>
                                                <option value="1">
                                                    Nhân viên
                                                </option>
                                                <option value="2">
                                                    Quản trị
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="address" class="col-md-3 text-md-right col-form-label">Địa chỉ<strong
                                                style="color: red">*</strong></label>
                                        <div class="col-md-3 col-xl-2">
                                            <select class="form-control form-select form-select-sm mb-3" id="city"
                                                aria-label=".form-select-sm">
                                                <option value="" selected>Chọn tỉnh thành</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-xl-2">
                                            <select class=" form-control form-select form-select-sm mb-3" id="district"
                                                aria-label=".form-select-sm">
                                                <option value="" selected>Chọn quận huyện</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-xl-2">
                                            <select class="form-control form-select form-select-sm" id="ward"
                                                aria-label=".form-select-sm">
                                                <option value="" selected>Chọn phường xã</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group" style="top:-10px">
                                        <label for="address" class="col-md-3 text-md-right col-form-label"></label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="address" id="address" placeholder="Nhập địa chỉ" type="text"
                                                class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="phone_number" class="col-md-3 text-md-right col-form-label">Số điện
                                            thoại<strong style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="phone_number" id="phone_number" placeholder="Nhập số điện thoại"
                                                type="tel" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="email" class="col-md-3 text-md-right col-form-label">Email<strong
                                                style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Nhập Email" value="">
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="password" class="col-md-3 text-md-right col-form-label">Mật khẩu<strong
                                                style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="password" id="password" placeholder="Nhập mật khẩu"
                                                type="password" class="form-control" value="">
                                            <span class="change-pasword"><i class="fas fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="password_confirmation"
                                            class="col-md-3 text-md-right col-form-label">Nhập
                                            lại
                                            mật khẩu<strong style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="password_confirmation" id="password_confirmation"
                                                placeholder="Nhập lại mật khẩu" type="password" class="form-control"
                                                value="">
                                            <span class="change-pasword"><i class="fas fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group mb-1">
                                        <div class="col-md-9 col-xl-8 offset-md-2">
                                            <a href="./admin/employee" class="border-0 btn btn-outline-danger mr-1">
                                                <span class="btn-icon-wrapper pr-1 opacity-8">
                                                    <i class="fa fa-times fa-w-20"></i>
                                                </span>
                                                <span>Hủy</span>
                                            </a>
                                            <button type="button" class="btn-shadow btn-hover-shine btn btn-primary"
                                                id="btn-create-employee">
                                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                                    <i class="fa fa-download fa-w-20"></i>
                                                </span>
                                                <span>Thêm</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 " style="color: #3f6ad8;">
                                    <div class="row d-flex justify-content-center text-align-center">
                                        <label for="image-profile" class="file-image">
                                            <img class="w-100" src="{{ 'images/default-image.jpg' }}" alt=""
                                                id="avt-review">
                                        </label>
                                        <input class="image_product" type="file" name="image_profile"
                                            id="image-profile" style="display:none;">
                                    </div>
                                    <div class="row d-flex justify-content-center text-align-center">
                                        <h5 id="review-name"></h5>
                                    </div>
                                    <div class="row d-flex justify-content-center text-align-center">
                                        <h6 id="review-position"></h6>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </form>
                    </div>
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
    <!-- End Main -->
@endsection
