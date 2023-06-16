@extends('layouts.app')
@section('content')
    <div class="body-product-cart">
        <div class="body-cart mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="row d-flex justify-content-center my-4">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h5 class="mb-0">Thông tin giao hàng</h5>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative row form-group p-2">
                                        <label for="name" class="col-md-3 text-md-right col-form-label">Họ và tên<strong
                                                style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="name" id="name" placeholder="Nhập tên" type="text"
                                                class="form-control" value="{{ auth()->user()->name }}">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group  p-2">
                                        <label for="phone_number" class="col-md-3 text-md-right col-form-label">Số điện
                                            thoại<strong style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="phone_number" id="phone_number" placeholder="Nhập số điện thoại"
                                                type="text" class="form-control"
                                                value="{{ auth()->user()->phone_number }}">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group  p-2">
                                        <label for="cityy" class="col-md-3 text-md-right col-form-label">Tỉnh
                                            thành<strong style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <select class="form-control form-select form-select-sm mb-3" id="cityy"
                                                aria-label=".form-select-sm">
                                                <option value="" selected>Chọn tỉnh thành</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group  p-2">
                                        <label for="districtt" class="col-md-3 text-md-right col-form-label">Quận
                                            huyện<strong style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <select class=" form-control form-select form-select-sm mb-3" id="districtt"
                                                aria-label=".form-select-sm">
                                                <option value="" selected>Chọn quận huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group  p-2">
                                        <label for="wardd" class="col-md-3 text-md-right col-form-label">Xã
                                            phươngf<strong style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <select class="form-control form-select form-select-sm" id="wardd"
                                                aria-label=".form-select-sm">
                                                <option value="" selected>Chọn phường xã</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group  p-2">
                                        <label for="address" class="col-md-3 text-md-right col-form-label">Địa chỉ<strong
                                                style="color: red">*</strong></label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="address" id="address" placeholder="Địa chỉ" type="text"
                                                class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group  p-2">
                                        <label for="order_notes" class="col-md-3 text-md-right col-form-label">Ghi chú giao
                                            hàng</label>
                                        <div class="col-md-9 col-xl-8">
                                            <textarea class="form-control" name="order_notes" id="order_notes" placeholder="Ghi chú"></textarea>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <section class="h-100 gradient-custom">
                            <div class="container ">
                                <div class="row d-flex justify-content-center my-4">
                                    <div class="col-md-8">
                                        <div class="card mb-4">
                                            <div class="card-header py-3">
                                                <div class="row">
                                                    <div class="col-6 d-flex justify-content-start">
                                                        <h5 class="mb-0"><a href="/shop"><i
                                                                    class="fas fa-long-arrow-alt-left"></i></a> Giỏ
                                                            hàng</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @php
                                                    $total = 0;
                                                    $i = 1;
                                                @endphp
                                                @if (session('cart'))
                                                    @foreach (session('cart') as $id => $details)
                                                        @php $total += $details['priceDiscount'] * $details['quantity'] @endphp
                                                        <!-- Single item -->
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                                                <!-- Image -->
                                                                <div class="bg-image hover-overlay hover-zoom ripple rounded text-center"
                                                                    data-mdb-ripple-color="light">
                                                                    <img src="{{ asset('images/image_products_home/') }}/{{ $details['image'] }}"
                                                                        style="width: 40px;" alt="Watch"
                                                                        style="" />
                                                                </div>
                                                                <!-- Image -->
                                                            </div>
                                                            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                                                <!-- Data -->
                                                                <p><strong>{{ $details['name'] }}</strong></p>
                                                                <p>
                                                                <div class="row">
                                                                    <div class="col-4"><strong>Loại</strong>:
                                                                        {{ $details['gender'] }}</div>
                                                                    <div class="col-5"> <strong>Hãng</strong>:
                                                                        {{ $details['brand'] }}</div>
                                                                    <div class="col-3"><strong>SL</strong>:
                                                                        {{ $details['quantity'] }}</div>
                                                                </div>
                                                                </p>
                                                                <!-- Data -->
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                                                <!-- Price -->
                                                                <p class="text-start text-md-center">
                                                                    <strong>{{ number_format($details['total']) . ' VNĐ' }}</strong>
                                                                </p>
                                                                <!-- Price -->
                                                            </div>
                                                        </div>
                                                        <hr style="margin: 0 !important;">
                                                        <!-- Single item -->
                                                        @php $i++; @endphp
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mb-4">
                                            <div class="card-header py-3">
                                                <h5 class="mb-0">Tổng</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                                        Sản phẩm
                                                        <span>{{ number_format($total) . ' VNĐ' }}</span>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        Vận chuyển
                                                        <span>Miễn phí</span>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                                        <div>
                                                            <strong>Tổng thanh toán</strong>
                                                            <strong>
                                                                <p class="mb-0">(bao gồm VAT 8%)</p>
                                                            </strong>
                                                        </div>
                                                        <span>
                                                            <strong>
                                                                @php $totalVAT = $total + ($total * 0.08);   @endphp
                                                                {{ number_format($totalVAT) . ' VNĐ' }}
                                                                <input type="hidden" value="{{ $totalVAT }}" id="totalVAT">
                                                            </strong>
                                                        </span>
                                                    </li>
                                                </ul>
                                                <hr>
                                                <h5><strong>Phương thức thanh toán</strong></h5>
                                                <input type="radio" name="payment_method" id="cash"
                                                    value="cash" style="cursor: pointer;"> <strong><label
                                                        for="cash" style="cursor: pointer;">Tiền mặt</label>
                                                </strong><img class="me-2" width="45px"
                                                    src="{{ asset('images/cash.png') }}" alt="cash" /> <br>
                                                <input type="radio" name="payment_method" value="bank"
                                                    id="bank" style="cursor: pointer;"><strong> <label
                                                        for="bank" style="cursor: pointer;"> Ngân hàng</label>
                                                </strong> <img class="me-2" width="45px"
                                                    src="{{ asset('images/vnpay.png') }}" alt="vnpay" /><br>
                                                <input type="radio" name="payment_method" value="momo"
                                                    id="momo" style="cursor: pointer;">
                                                <strong> <label for="momo"
                                                        style="cursor: pointer;">Momo</label></strong><img class="me-2"
                                                    width="45px" src="{{ asset('images/momo.png') }}"
                                                    alt="momo" /><br>
                                                <button type="button" class="btn btn-primary btn-lg btn-block "
                                                    id="payment" style="margin-top:40px ">
                                                    Tiến hành thanh toán
                                                </button>
                                                <input type="hidden" name="" id="id-customer"
                                                    value="{{ auth()->user()->id }}">
                                            </div>
                                        </div>
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <p><strong>Giao hàng dự kiến</strong></p>
                                                {{-- giao hàng trong vòng 4 ngày  --}}
                                                <p class="mb-0">
                                                    {{ date('d/m/Y', strtotime($time)) . ' - ' . date('d/m/Y', strtotime($time . ' +4 days')) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
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
                    $("#address").val(response.address);
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
