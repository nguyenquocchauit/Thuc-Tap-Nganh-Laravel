@extends('admin.layout.master')
@section('body')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                        </div>
                        <div>
                            Thống kê
                            <div class="page-title-subheading">
                               Khách hàng, <strong>đơn hàng</strong>, doanh thu.
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <a href="./admin/report/order?start_day={{ request()->start_day }}&end_day={{ request()->end_day }}&unconfimred=true&search="
                        style="text-decoration: none;">
                        <div class="card gradient-6 unconfimred">
                            <div class="card-body">
                                <h3 class="card-title text-white">Chưa xác nhận</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $unconfirmed }}</h2>
                                    <input type="hidden" value="{{ $unconfirmed }}" class="unconfimred">


                                </div>
                                <span class="float-right display-5 opacity-5 icon-check "><i
                                        class="fa fa-check "></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="./admin/report/order?start_day={{ request()->start_day }}&end_day={{ request()->end_day }}&received=true&search="
                        style="text-decoration: none;">

                        <div class="card gradient-1 received">
                            <div class="card-body">
                                <h3 class="card-title text-white">Thành công</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $received }}</h2>
                                    <input type="hidden" value="{{ $received }}" name="received">

                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="./admin/report/order?start_day={{ request()->start_day }}&end_day={{ request()->end_day }}&shipping=true&search="
                        style="text-decoration: none;">

                        <div class="card gradient-4 shipping">
                            <div class="card-body">
                                <h3 class="card-title text-white">Đang vận chuyển</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $shipping }}</h2>
                                    <input type="hidden" value="{{ $shipping }}" name="shipping">

                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fas fa-truck"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="./admin/report/order?start_day={{ request()->start_day }}&end_day={{ request()->end_day }}&fail=true&search="
                        style="text-decoration: none;">
                        <div class="card gradient-2 fail">
                            <div class="card-body">
                                <h3 class="card-title text-white">Thất bại</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $fail }}</h2>
                                    <input type="hidden" value="{{ $fail }}" name="fail">

                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-times"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card tabs-card">
                <div class="card-block p-0">
                    <!-- Nav tabs -->
                    <div class="row">
                        <div class="col-12 nav-report-customer">
                            <ul class="nav nav-tabs md-tabs" role="tablist">

                                <li class="nav-item ">
                                    <a class="nav-link a-customer active" data-toggle="tab" href="#customer"
                                        data-id="customer" role="tab"><i class="fa fa-table">
                                        </i>&nbsp;Đơn hàng</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item"></li>
                                <li class="nav-item">
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-end">
                                            <input type="date" class="form-control" id="start_day" name="start_day"
                                                lang="vi" value="{{ request()->start_day }}" />
                                            <input type="date" class="form-control" id="end_day" name="end_day"
                                                lang="vi" value="{{ request()->end_day }}" />
                                        </div>
                                        <div class="col-6 input-group d-flex justify-content-center">
                                            <input type="search" name="search" id="search-order"
                                                value="{{ request()->search }}" placeholder="Tìm kiếm"
                                                class="form-control">
                                            <button type="submit" class="btn btn-primary " id="btn-search-report-order">
                                                <i class="fa fa-search"></i>&nbsp;
                                                Tìm
                                            </button>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                        </div>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="order" data-id="a-order" role="tabpanel">
                            <div class="table-responsive text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã đơn</th>
                                            <th>Khách hàng</th>
                                            <th>SĐT</th>
                                            <th>Mua vào</th>
                                            <th>Trạng thái</th>
                                            <th>Cập nhật</th>
                                            <th>Tổng tiền</th>
                                            <th>Thanh toán</th>
                                            <th>Nhân viên</th>
                                            <th>Ghi chú</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $order->idOrder }}</td>
                                                <td>
                                                    <a style="color: #006468;"
                                                        href="/admin/customer/{{ $order->id_customer }}/edit"
                                                        target="_blank">{{ $order->name_customer }}</a>
                                                </td>
                                                <td>{{ $order->phone }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    <div>
                                                        <input type="hidden" value="{{ $order->idOrder }}">
                                                        @if ($order->status == 'DVC')
                                                            <button class="button select-dvc"
                                                                style="border-radius: 20px; height: 100% !important;">
                                                                Đang vận chuyển</button>
                                                        @endif
                                                        @if ($order->status == 'TC')
                                                            <button class="button select-tc"
                                                                style="border-radius: 20px; height: 100% !important;">
                                                                Thành công</button>
                                                        @endif
                                                        @if ($order->status == 'TB')
                                                            <button class="button select-tb"
                                                                style="border-radius: 20px; height: 100% !important;">
                                                                Thất bại</button>
                                                        @endif
                                                        @if ($order->status == 'XN')
                                                            <button class="button select-xn"
                                                                style="border-radius: 20px; height: 100% !important;">
                                                                Chưa xác nhận</button>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $order->updated_at }}</td>
                                                <td>{{ number_format($order->total) . ' VNĐ' }}</td>
                                                <td>
                                                    @if ($order->status_payment == 0)
                                                        <strong>Chưa thanh toán</strong>
                                                    @endif
                                                    @if ($order->status_payment == 1)
                                                        <strong style="color: green">Đã thanh toán</strong>
                                                    @endif
                                                    @if ($order->status_payment == 2)
                                                        <strong style="color: red">Thanh toán thất bại</strong>
                                                    @endif
                                                </td>
                                                @if (
                                                    $order->id_employee ==
                                                        auth()->guard('admin')->user()->id)
                                                    <td>Bạn</td>
                                                @else
                                                    <td>
                                                        <a style="color: #006468;"
                                                            href="/admin/employee/{{ $order->id_employee }}/edit"
                                                            target="_blank">{{ $order->name_employee }}</a>
                                                    </td>
                                                @endif
                                                <td> <textarea cols="20" rows="2">{{ $order->note }}</textarea></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-block card-footer">
                                {!! $orders->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            if (((urlParams.has("start_day") && urlParams.get("start_day") == "") && (urlParams.has("end_day") &&
                    urlParams.get("end_day") == "")) || !urlParams.has("start_day") && !urlParams.has("end_day")) {
                var now = new Date();
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var today = now.getFullYear() + "-" + (month) + "-" + (day);
                $("#end_day").val(today);
                var today = new Date();
                var firstDay = new Date(today.getFullYear(), today.getMonth(), 2);
                $("#start_day").val(firstDay.toISOString().slice(0, 10));
            }
            $("#btn-search-report-order").on("click", function() {
                var start_day = $("#start_day").val();
                var end_day = $("#end_day").val();
                var label = null;
                var search = $("#search-order").val();
                if (urlParams.has("unconfimred") && urlParams.get("unconfimred") == "true")
                    label = "unconfimred=true";
                if (urlParams.has("received") && urlParams.get("received") == "true")
                    label = "received=true";
                if (urlParams.has("shipping") && urlParams.get("shipping") == "true")
                    label = "shipping=true";
                if (urlParams.has("fail") && urlParams.get("fail") == "true")
                    label = "fail=true";
                if (urlParams.has("search") && urlParams.get("search") == "")
                    search = "";
                window.location.href = "/admin/report/order?start_day=" + start_day + "&end_day=" +
                    end_day + "&" + label + "&search=" + search + "";
            });
        });
    </script>
@endsection
