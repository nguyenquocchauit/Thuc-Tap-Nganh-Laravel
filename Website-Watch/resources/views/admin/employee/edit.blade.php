@extends('admin.layout.master')
@section('body')
    <div class="container-fluid">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Nhân viên
                        <div class="page-title-subheading">
                            Xem, tạo, <strong>sửa</strong>, xóa và quản lý.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="./admin/employee/create" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Tạo
                    </a>
                </div>
            </div>
        </div>
        <form id="update-profile-dashboard" method="post" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-update-employee">
                        <div class="header">
                            <h4 class="title">Thông tin</h4>
                        </div>
                        <div class="content">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Họ và tên</label>
                                        <input name="name" id="name" type="text" class="form-control"
                                            value="{{ $employee->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Chức vụ</label>
                                        <select name="role" id="position" class="form-control">
                                            <option value="">Chọn chức vụ</option>
                                            <option value="1" @if ($employee->role == '1') selected @endif>
                                                Nhân viên
                                            </option>
                                            <option value="2" @if ($employee->role == '2') selected @endif>
                                                Quản trị
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input name="phone_number" id="phone_number" type="text" class="form-control"
                                            value="{{ $employee->phone_number }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" id="email" type="email" class="form-control"
                                            value="{{ $employee->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tỉnh thành</label>
                                        <select class="form-control form-select form-select-sm mb-3" id="city"
                                            aria-label=".form-select-sm">
                                            <option value="" selected>Chọn tỉnh thành</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Quận huyện</label>
                                        <select class=" form-control form-select form-select-sm mb-3" id="district"
                                            aria-label=".form-select-sm">
                                            <option value="" selected>Chọn quận huyện</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Xã phường</label>
                                        <select class="form-control form-select form-select-sm" id="ward"
                                            aria-label=".form-select-sm">
                                            <option value="" selected>Chọn phường xã</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="address" id="address" placeholder="Nhập địa chỉ" type="text"
                                            class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-info btn-fill pull-right"
                                id="btn-update-employee-dashboard">Cập nhật</button>
                            <input type="hidden" name="" id="id-employee-dashboard" value="{{ $employee->id }}">

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-employee">
                        <div class="image">
                            <img src="{{ asset('images/banner-profile-dashboard.png') }}" alt="...">
                        </div>
                        <div class="content">
                            <div class="author">
                                <label for="image-profile-dashboard" class="file-image">
                                    <img class="avatar-profile border-gray" id="avatar-profile"
                                        src="{{ asset('images/employee/') }}/{{ $employee->avt }}" alt="...">
                                </label>
                                <input class="image_profile_dashboard" type="file" name="image_profile"
                                    id="image-profile-dashboard" style="display:none;">


                                <h4 class="title">{{ $employee->name }}<br>
                                    @if ($employee->role == '1')
                                        <small>Nhân viên</small>
                                    @else
                                        @if ($employee->role == '2')
                                            <small>Quản trị</small>
                                        @endif
                                    @endif
                                </h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tạo vào ngày</label>
                                        <input id="created_at" disabled="" type="text" class="form-control"
                                            value="">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cập nhật vào ngày</label>
                                        <input id="updated_at" disabled="" type="text" class="form-control"
                                            value="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        // Kiểm tra giá trị của phần tử có id là role-current-user
        if ($("#role-current-user").val() != 2) {
            // Nếu giá trị của phần tử có id là role-current-user khác 2 thì thuộc tính disable sẽ được thêm vào các phần tử có id là name, phone_number, email, city, district, ward, address và avatar-profile.
            $(
                "#name, #phone_number, #email, #city, #district, #ward, #address, #avatar-profile,#position,#btn-update-employee-dashboard",
            ).prop("disabled", true);

        }
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
                url: "/api/admin/employee/edit/" + $("#id-employee-dashboard").val(),
                type: "GET",
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#address").val(response.address);
                    $("#created_at").val(response.created_at);
                    $("#updated_at").val(response.updated_at);
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
@endsection
