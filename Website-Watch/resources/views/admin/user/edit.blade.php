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
                        <form id="update-customer" method="post" action="" enctype="multipart/form-data">

                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Tên</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name" id="name" placeholder="Nhập tên" type="text"
                                        class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="phone" class="col-md-3 text-md-right col-form-label">Số điện thoại</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="phone_number" id="phone_number" placeholder="Nhập số điện thoại"
                                        type="tel" class="form-control" value="{{ $user->phone_number }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="address" class="col-md-3 text-md-right col-form-label">Địa chỉ</label>
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
                                        class="form-control" value="{{ $address }}">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="email" id="email" placeholder="Nhập Email" type="email"
                                        class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="password" class="col-md-3 text-md-right col-form-label">Mật khẩu</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="password" id="password" placeholder="Nhập mật khẩu" type="password"
                                        class="form-control" value="">
                                </div>
                            </div>
                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="./admin/customer" class="border-0 btn btn-outline-danger mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="fa fa-times fa-w-20"></i>
                                        </span>
                                        <span>Hủy</span>
                                    </a>
                                    <button type="button" class="btn-shadow btn-hover-shine btn btn-primary"
                                        id="btn-update-customer">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="fa fa-download fa-w-20"></i>
                                        </span>
                                        <span>Lưu</span>
                                        <input type="hidden" name="" id="id-customer"
                                            value="{{ $user->id }}">
                                    </button>
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
            let dataCity = "null";
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "/api/admin/customer/edit/" + $("#id-customer").val(),
                type: "GET",
                contentType: false,
                processData: false,
                success: function(response) {
                    var idCitis = null;
                    var idDistrict = null;

                    for (const x of data) {
                        const option = new Option(x.Name, x.Id);
                        //// create the option tag and the option tag matches the database, then selected
                        if (x.Name === response.city) {
                            option.selected = true;
                            idCitis = x.Id;
                        }
                        citis.options[citis.options.length] = option;
                    }
                    // Get the list of districts/districts corresponding to the selected city
                    const result = data.filter(n => n.Id === idCitis);

                    for (const k of result[0].Districts) {
                        const option = new Option(k.Name, k.Id);
                        if (k.Name === response.district) {
                            option.selected = true;
                            idDistrict = k.Id;
                        }
                        district.options[district.options.length] = option;
                    }
                    // Get the list of cities, counties/districts corresponding to the selected city
                    const dataCity = data.filter((n) => n.Id === idCitis);
                    const dataWards = dataCity[0].Districts.filter(n => n.Id === idDistrict)[0].Wards;

                    for (const w of dataWards) {
                        const option = new Option(w.Name, w.Id);
                        if (w.Name === response.ward) {
                            option.selected = true;
                        }
                        wards.options[wards.options.length] = option;
                    }

                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
            });
            // check the change again when changing the province, the city and district will update again
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
