@extends('admin.layout.master')
@section('body')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <a href="./admin/report?time_select={{ request()->time_select }}&unconfimred=true"
                        style="text-decoration: none;">
                        <div class="card gradient-6">
                            <div class="card-body">
                                <h3 class="card-title text-white">Đơn hàng cần xác nhận</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $unconfimred }}</h2>
                                    <input type="hidden" value="{{ $unconfimred }}" class="unconfimred">
                                    <p class="text-white mb-0">{{ 'Tháng ' . $month . ' - Năm ' . $year }}</p>
                                </div>
                                <span class="float-right display-5 opacity-5 icon-check "><i
                                        class="fa fa-check "></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="./admin/report?time_select={{ request()->time_select }}&received=true"
                        style="text-decoration: none;">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Đơn hàng đã nhận</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $received }}</h2>
                                    <p class="text-white mb-0">{{ 'Tháng ' . $month . ' - Năm ' . $year }}</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="./admin/report?time_select={{ request()->time_select }}&shipping=true"
                        style="text-decoration: none;">

                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Đang vận chuyển</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $shipping }}</h2>
                                    <p class="text-white mb-0">
                                        {{ 'Tháng ' . $month . ' - Năm ' . $year }}
                                    </p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fas fa-truck"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="./admin/report?time_select={{ request()->time_select }}&fail=true"
                        style="text-decoration: none;">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Đơn hàng thất bại</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $fail }}</h2>
                                    <p class="text-white mb-0">{{ 'Tháng ' . $month . ' - Năm ' . $year }}</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-times"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card gradient-3">
                        <div class="card-body">
                            <h3 class="card-title text-white">Khách hàng mới</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">{{ $newbie }}</h2>
                                <p class="text-white mb-0">{{ 'Tháng ' . $month . ' - Năm ' . $year }}</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card gradient-5">
                        <div class="card-body">
                            <h3 class="card-title text-white">Doanh thu</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white revenue "></h2>
                                <input type="hidden" name="" id="revenue" value="{{ $revenue }}">
                                <p class="text-white mb-0">{{ 'Tháng ' . $month . ' - Năm ' . $year }}</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-coins"></i></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-sm-12">
            <div class="card tabs-card">
                <div class="card-block p-0">
                    <!-- Nav tabs -->
                    <div class="row">
                        <div class="col-12 nav-report">
                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active a-order" data-toggle="tab" href="#order" data-id="order"
                                        role="tab"><i class="fa fa-home">
                                        </i>&nbsp;Đơn hàng</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link a-customer" data-toggle="tab" href="#customer" data-id="customer"
                                        role="tab"><i class="fa fa-table">
                                        </i>&nbsp;Khách hàng</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link a-revenues" data-toggle="tab" href="#revenues" data-id="revenues"
                                        role="tab"><i class="fa fa-table">
                                        </i>&nbsp;Doanh thu</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <form id="time-report" action="" method="GET">
                                        <div class="row">
                                            <div class="col-11 d-flex justify-content-end">
                                                <input type="month" class="form-control" id="time_select"
                                                    name="time_select" lang="vi" onchange="this.form.submit()"
                                                    value="{{ request()->time_select }}" />
                                            </div>
                                            {{-- <div class="col-6 input-group d-flex justify-content-center"
                                                style="padding-right: 35px;">
                                                <input type="search" name="search" id="search"
                                                    value="{{ request()->search }}" placeholder="Tìm kiếm"
                                                    class="form-control">
                                                <button type="submit" class="btn btn-primary " id="btn-search-report">
                                                    <i class="fa fa-search"></i>&nbsp;
                                                    Tìm
                                                </button>
                                            </div> --}}

                                        </div>
                                    </form>
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
                                            <th>Nhân viên</th>
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
                                                        <select disabled=""
                                                            class="form-control mx-auto status text-center
                                                                @if ($order->status == 'DVC') select-dvc @endif
                                                                @if ($order->status == 'TC') select-tc @endif
                                                                @if ($order->status == 'TB') select-tb @endif
                                                                @if ($order->status == 'XN') select-xn @endif
                                                                "
                                                            name="status" id="status">
                                                            <option value="DVC"
                                                                @if ($order->status == 'DVC') selected @endif>Đang vận
                                                                chuyển</option>
                                                            <option value="TC"
                                                                @if ($order->status == 'TC') selected @endif>Thành công
                                                            </option>
                                                            <option value="TB"
                                                                @if ($order->status == 'TB') selected @endif>Thất bại
                                                            </option>
                                                            <option value="XN"
                                                                @if ($order->status == 'XN') selected @endif>Chưa xác
                                                                nhận
                                                            </option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>{{ $order->updated_at }}</td>
                                                <td>{{ number_format($order->total) . ' VNĐ' }}</td>
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

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-block card-footer">
                                {!! $orders->links() !!}
                            </div>
                        </div>
                        <div class="tab-pane " id="customer" data-id="a-customer"role="tabpanel">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Mã khách hàng</th>
                                                    <th>Tên</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Email</th>
                                                    <th>Tạo ngày</th>
                                                    <th>Cập nhật ngày</th>
                                                    <th>Số đơn hàng</th>
                                                    <th>Tổng tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($customers as $key => $customer)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $customer->id }}</td>
                                                        <td>{{ $customer->name }}</td>
                                                        <td>{{ $customer->phone_number }}</td>
                                                        <td>{{ $customer->address }}</td>
                                                        <td>{{ $customer->email }}</td>
                                                        <td>{{ date(' H:i:s d-m-Y', strtotime($customer->created_at)) }}
                                                        </td>
                                                        <td>{{ date(' H:i:s d-m-Y', strtotime($customer->updated_at)) }}
                                                        </td>
                                                        @if ($customer->userTotalOrder == 0)
                                                            <td>Chưa mua</td>
                                                        @else
                                                            <td>{{ $customer->userTotalOrder }}</td>
                                                        @endif
                                                        @if ($customer->userTotalMoney == 0)
                                                            <td></td>
                                                        @else
                                                            <td>{{ number_format($customer->userTotalMoney) . ' VNĐ' }}
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane " id="revenues" data-id="a-revenue"role="tabpanel">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Hãng</th>
                                                    <th>Loại</th>
                                                    <th>Số lượng</th>
                                                    <th>Tổng tiền</th>
                                                </tr>
                                            </thead>
                                            @foreach ($revenueBrands as $key => $revenueBrand)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $revenueBrand->name_brand }}</td>
                                                    @if ($revenueBrand->gender_brand == '1')
                                                        <td>Nam</td>
                                                    @else
                                                        <td> Nữ</td>
                                                    @endif
                                                    <td>{{ $revenueBrand->quantity_brand }}</td>
                                                    <td>{{ number_format($revenueBrand->total_brand) . ' VNĐ' }}</td>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @php
                                                $percentFail = $percentReceived = 0;
                                            @endphp
                                            @if ($fail > 0)
                                                @php
                                                    $percentFail = ($fail / $totalOrder) * 100;
                                                @endphp
                                                <input type="hidden" id="chart-fail" value="{{ $percentFail }}">
                                            @else
                                                <input type="hidden" id="chart-fail" value="{{ $percentFail }}">
                                            @endif
                                            @if ($received > 0)
                                                @php
                                                    $percentReceived = ($received / $totalOrder) * 100;
                                                @endphp
                                                <input type="hidden" id="chart-received"value="{{ $percentReceived }}">
                                            @else
                                                <input type="hidden" id="chart-received"value="{{ $percentReceived }}">
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-9 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="chartjs-size-monitor"
                                                style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                <div class="chartjs-size-monitor-expand"
                                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                    <div
                                                        style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                                    </div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink"
                                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <p class="card-title mx-auto">Thống kê số lượng được bán của các hãng theo
                                                    tháng trong năm {{ $year }}</p>
                                                <div id="cash-deposits-chart-legend"
                                                    class="d-flex justify-content-center pt-3 w-100"></div>
                                            </div>
                                            <canvas id="cash-deposits-chart" width="870" height="435"
                                                style="display: block; width: 870px; height: 435px;"
                                                class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 grid-margin stretch-card-circle">
                                    <div class="card" style="min-height: 300px;">
                                        <div class="card-header justify-content-center">
                                            <p class="card-title mx-auto">Tỉ lệ % giao hàng thành công</p>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="sales-chart-c" class="mt-2"></canvas>
                                            <ul class="navbar-nav dashboard-chart-legend">
                                                <li class="nav-item"><span style="background-color: #04fb00 "></span>
                                                    Thành công</li>
                                                <li class="nav-item"><span style="background-color: #ff4747  "></span>
                                                    Thất bại</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
