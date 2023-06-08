@extends('layouts.app')
@section('content')
    <div class="container-fluid p-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card-profile-customer">
                    <div class="header">
                        <h4 class="title">Cập nhật thông tin</h4>
                    </div>
                    <div class="content">
                        <form id="update-profile-customer" method="post" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Họ và tên</label>
                                        <input name="name" type="text" class="form-control"
                                            value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input name="phone_number" type="text" class="form-control"
                                            value="{{ auth()->user()->phone_number }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="email" class="form-control"
                                            value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tỉnh thành</label>
                                        <select class="form-control form-select form-select-sm mb-3" id="cityy"
                                            aria-label=".form-select-sm">
                                            <option value="" selected>Chọn tỉnh thành</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Quận huyện</label>
                                        <select class=" form-control form-select form-select-sm mb-3" id="districtt"
                                            aria-label=".form-select-sm">
                                            <option value="" selected>Chọn quận huyện</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Xã phường</label>
                                        <select class="form-control form-select form-select-sm" id="wardd"
                                            aria-label=".form-select-sm">
                                            <option value="" selected>Chọn phường xã</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="address" id="addresss" placeholder="Nhập địa chỉ" type="text"
                                            class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-info btn-fill" style="margin: 5px; float: right;"
                                id="btn-update-customer">Cập nhật</button>
                            <input type="hidden" name="" id="id-customer" value="{{ auth()->user()->id }}">

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-customer">
                    <div class="image">
                        <img src="{{ asset('images/banner-profile-dashboard.png') }}" alt="...">
                    </div>
                    <div class="content">
                        <div class="author">
                            <label for="image-customer" class="file-image">
                                <img class="avatar-customer border-gray" id="avatar-customer"
                                    src="{{ asset('images/none.png') }}" alt="...">
                            </label>
                            <h4 class="title">{{ auth()->user()->name }}<br>
                                <small>Khách hàng</small>
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
                <div class="card card-password">

                    <div class="card-header">
                        <h5 class="mb-0">Đổi Mật Khẩu</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="old-password">Mật Khẩu Cũ</label>
                            <input class="form-control" id="old-password" type="password"
                                placeholder="Nhập mật khẩu hiện tại">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="new-password">Mật Khẩu Mới</label>
                            <input class="form-control" id="new-password" type="password"
                                placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="confirm-password">Xác Nhận Mật Khẩu</label>
                            <input class="form-control" id="confirm-password" type="password"
                                placeholder="Xác nhận mật khẩu">
                        </div>
                        <button type="button" class="btn btn-primary btn-block" id="bth-update-pass-profile-customer">
                            Đổi Mật Khẩu </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citiss = document.getElementById("cityy");
        var districtss = document.getElementById("districtt");
        var wardss = document.getElementById("wardd");
        var Parameters = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promises = axios(Parameters);
        promises.then(function(result) {
            renderCitys(result.data);
        });

        function renderCitys(data) {
            let dataCity = "null";
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "/api/profile/edit/" + $("#id-customer").val(),
                type: "GET",
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#addresss").val(response.address);
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
                        citiss.options[citiss.options.length] = option;
                    }
                    // Get the list of districts/districts corresponding to the selected city
                    const result = data.filter(n => n.Id === idCitis);

                    for (const k of result[0].Districts) {
                        const option = new Option(k.Name, k.Id);
                        if (k.Name === response.district) {
                            option.selected = true;
                            idDistrict = k.Id;
                        }
                        districtss.options[districtss.options.length] = option;
                    }
                    // Get the list of cities, counties/districts corresponding to the selected city
                    const dataCity = data.filter((n) => n.Id === idCitis);
                    const dataWards = dataCity[0].Districts.filter(n => n.Id === idDistrict)[0].Wards;

                    for (const w of dataWards) {
                        const option = new Option(w.Name, w.Id);
                        if (w.Name === response.ward) {
                            option.selected = true;
                        }
                        wardss.options[wardss.options.length] = option;
                    }

                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
            });
            // check the change again when changing the province, the city and district will update again
            citiss.onchange = function() {
                districtss.length = 1;
                wardss.length = 1;
                if (this.value != "") {
                    const result = data.filter(n => n.Id === this.value);

                    for (const k of result[0].Districts) {
                        districtss.options[districtss.options.length] = new Option(k.Name, k.Id);
                    }
                }
            };
            districtss.onchange = function() {
                wardss.length = 1;
                const dataCity = data.filter((n) => n.Id === citiss.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wardss.options[wardss.options.length] = new Option(w.Name, w.Id);
                    }
                }
            };
        }
    </script>
@endsection
