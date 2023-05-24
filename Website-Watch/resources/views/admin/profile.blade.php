@extends('admin.layout.master')
@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card-profile">
                    <div class="header">
                        <h4 class="title">Cập nhật thông tin</h4>
                    </div>
                    <div class="content">
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Họ và tên</label>
                                        <input type="text" class="form-control"
                                            value="{{ auth()->guard('admin')->user()->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input type="text" class="form-control"
                                            value="{{ auth()->guard('admin')->user()->phone_number }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control"
                                            value="{{ auth()->guard('admin')->user()->email }}">
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


                            <button type="submit" class="btn btn-info btn-fill pull-right">Cập nhật</button>
                            <input type="hidden" name="" id="id-employee"
                                value="{{ auth()->guard('admin')->user()->id }}">
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&amp;fm=jpg&amp;h=300&amp;q=75&amp;w=400"
                            alt="...">
                    </div>
                    <div class="content">
                        <div class="author">
                            <a href="#">
                                <img class="avatar border-gray"
                                    src="{{ asset('images/employee/') }}/{{ auth()->guard('admin')->user()->avt }}"
                                    alt="...">

                                <h4 class="title">{{ auth()->guard('admin')->user()->name }}<br>
                                    @if (auth()->guard('admin')->user()->role == '1')
                                        <small>Nhân viên</small>
                                    @else
                                        @if (auth()->guard('admin')->user()->role == '2')
                                            <small>Quản trị</small>
                                        @endif
                                    @endif

                                </h4>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tạo vào ngày</label>
                                    <input id="created_at" disabled="" type="text" class="form-control" value="">

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
                        <button class="btn btn-primary btn-block"> Đổi Mật Khẩu </button>
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
                url: "/api/admin/profile/edit/" + $("#id-employee").val(),
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
