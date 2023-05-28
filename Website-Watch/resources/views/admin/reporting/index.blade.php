@extends('admin.layout.master')
@section('body')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <a href="./admin/report?time_select={{ request()->time_select }}&unconfimred=true&received={{ request()->received }}&shipping={{ request()->shipping }}&fail={{ request()->fail }}"
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
                    <a href="./admin/report?time_select={{ request()->time_select }}&unconfimred={{ request()->unconfimred }}&received=true&shipping={{ request()->shipping }}&fail={{ request()->fail }}"
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
                    <a href="./admin/report?time_select={{ request()->time_select }}&unconfimred={{ request()->unconfimred }}&received={{ request()->received }}&shipping=true&fail={{ request()->fail }}"
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
                    <a href="./admin/report?time_select={{ request()->time_select }}&unconfimred={{ request()->unconfimred }}&received={{ request()->received }}&shipping={{ request()->shipping }}&fail=true"
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
                                            <div class="col-6 d-flex justify-content-end">
                                                <input type="month" class="form-control" id="time_select"
                                                    name="time_select" lang="vi" onchange="this.form.submit()"
                                                    value="{{ request()->time_select }}" />
                                            </div>
                                            <div class="col-6 input-group d-flex justify-content-center"
                                                style="padding-right: 35px;">
                                                <input type="search" name="search" id="search"
                                                    value="{{ request()->search }}" placeholder="Tìm kiếm"
                                                    class="form-control">
                                                <button type="submit" class="btn btn-primary " id="btn-search-report">
                                                    <i class="fa fa-search"></i>&nbsp;
                                                    Tìm
                                                </button>
                                            </div>

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
                                            <th>Hành động</th>
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
                                                <td><a href="/admin/order?customer={{ $order->idOrder }}"
                                                        data-toggle="tooltip" title="Chi tiết đơn hàng"
                                                        data-placement="bottom" target="_blank"
                                                        class="btn btn-outline-warning border-0 btn-sm">
                                                        <span class="btn-icon-wrapper opacity-8">
                                                            <i class="fa fa-edit fa-w-20"></i>
                                                        </span>
                                                    </a></td>
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
                                                    <th>Hành động</th>
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
                                                    <th>Tỉ lệ thành công</th>
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
                                                    <td>{{ number_format(($revenueBrand->TC / $revenueBrand->quantity_brand) * 100, 2) }}%
                                                    </td>

                                                    <td>{{ $revenueBrand->order_count }}</td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-7 grid-margin stretch-card">
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
                                                <div class="col-sm-9">
                                                    <p class="card-title">Thống kê số lượng được bán của các hãng theo
                                                        tháng trong năm 2023</p>
                                                </div>
                                                <div class="col-sm-3" >
                                                    <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                                                </div>
                                            </div>

                                            <canvas id="cash-deposits-chart" width="870" height="435"
                                                style="display: block; width: 870px; height: 435px;"
                                                class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 grid-margin stretch-card">
                                    <div class="card" style="min-height: 422px;">
                                        <div class="card-header">
                                            <h3>Donut chart</h3>
                                        </div>
                                        <div class="card-body">
                                            <div id="c3-donut-chart" class="c3"
                                                style="max-height: 320px; position: relative;"><svg width="275.328125"
                                                    height="320" style="overflow: hidden;">
                                                    <defs>
                                                        <clipPath id="c3-1685261310890-clip">
                                                            <rect width="275.328125" height="266"></rect>
                                                        </clipPath>
                                                        <clipPath id="c3-1685261310890-clip-xaxis">
                                                            <rect x="-31" y="-20" width="337.328125"
                                                                height="70"></rect>
                                                        </clipPath>
                                                        <clipPath id="c3-1685261310890-clip-yaxis">
                                                            <rect x="-29" y="-4" width="20"
                                                                height="290"></rect>
                                                        </clipPath>
                                                        <clipPath id="c3-1685261310890-clip-grid">
                                                            <rect width="275.328125" height="266"></rect>
                                                        </clipPath>
                                                        <clipPath id="c3-1685261310890-clip-subchart">
                                                            <rect width="275.328125" height="0"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <g transform="translate(0.5,4.5)"><text class="c3-text c3-empty"
                                                            text-anchor="middle" dominant-baseline="middle"
                                                            x="137.6640625" y="133" style="opacity: 0;"></text>
                                                        <g clip-path="url(https://themewagon.github.io/themekit/?_ga=2.185235305.151776487.1685172181-2118687564.1682662673#c3-1685261310890-clip)"
                                                            class="c3-regions" style="visibility: hidden;"></g>
                                                        <g clip-path="url(https://themewagon.github.io/themekit/?_ga=2.185235305.151776487.1685172181-2118687564.1682662673#c3-1685261310890-clip-grid)"
                                                            class="c3-grid" style="visibility: hidden;">
                                                            <g class="c3-xgrid-focus">
                                                                <line class="c3-xgrid-focus" x1="-10"
                                                                    x2="-10" y1="0" y2="266"
                                                                    style="visibility: hidden;"></line>
                                                            </g>
                                                        </g>
                                                        <g clip-path="url(https://themewagon.github.io/themekit/?_ga=2.185235305.151776487.1685172181-2118687564.1682662673#c3-1685261310890-clip)"
                                                            class="c3-chart">
                                                            <g class="c3-event-rects" style="fill-opacity: 0;">
                                                                <rect class="c3-event-rect" x="0" y="0"
                                                                    width="275.328125" height="266"></rect>
                                                            </g>
                                                            <g class="c3-chart-bars">
                                                                <g class="c3-chart-bar c3-target c3-target-setosa"
                                                                    style="pointer-events: none;">
                                                                    <g class=" c3-shapes c3-shapes-setosa c3-bars c3-bars-setosa"
                                                                        style="cursor: pointer;"></g>
                                                                </g>
                                                                <g class="c3-chart-bar c3-target c3-target-versicolor"
                                                                    style="pointer-events: none;">
                                                                    <g class=" c3-shapes c3-shapes-versicolor c3-bars c3-bars-versicolor"
                                                                        style="cursor: pointer;"></g>
                                                                </g>
                                                                <g class="c3-chart-bar c3-target c3-target-virginica"
                                                                    style="pointer-events: none;">
                                                                    <g class=" c3-shapes c3-shapes-virginica c3-bars c3-bars-virginica"
                                                                        style="cursor: pointer;"></g>
                                                                </g>
                                                            </g>
                                                            <g class="c3-chart-lines">
                                                                <g class="c3-chart-line c3-target c3-target-setosa"
                                                                    style="opacity: 1; pointer-events: none;">
                                                                    <g
                                                                        class=" c3-shapes c3-shapes-setosa c3-lines c3-lines-setosa">
                                                                    </g>
                                                                    <g
                                                                        class=" c3-shapes c3-shapes-setosa c3-areas c3-areas-setosa">
                                                                    </g>
                                                                    <g
                                                                        class=" c3-selected-circles c3-selected-circles-setosa">
                                                                    </g>
                                                                    <g class=" c3-shapes c3-shapes-setosa c3-circles c3-circles-setosa"
                                                                        style="cursor: pointer;"></g>
                                                                </g>
                                                                <g class="c3-chart-line c3-target c3-target-versicolor"
                                                                    style="opacity: 1; pointer-events: none;">
                                                                    <g
                                                                        class=" c3-shapes c3-shapes-versicolor c3-lines c3-lines-versicolor">
                                                                    </g>
                                                                    <g
                                                                        class=" c3-shapes c3-shapes-versicolor c3-areas c3-areas-versicolor">
                                                                    </g>
                                                                    <g
                                                                        class=" c3-selected-circles c3-selected-circles-versicolor">
                                                                    </g>
                                                                    <g class=" c3-shapes c3-shapes-versicolor c3-circles c3-circles-versicolor"
                                                                        style="cursor: pointer;"></g>
                                                                </g>
                                                                <g class="c3-chart-line c3-target c3-target-virginica"
                                                                    style="opacity: 1; pointer-events: none;">
                                                                    <g
                                                                        class=" c3-shapes c3-shapes-virginica c3-lines c3-lines-virginica">
                                                                    </g>
                                                                    <g
                                                                        class=" c3-shapes c3-shapes-virginica c3-areas c3-areas-virginica">
                                                                    </g>
                                                                    <g
                                                                        class=" c3-selected-circles c3-selected-circles-virginica">
                                                                    </g>
                                                                    <g class=" c3-shapes c3-shapes-virginica c3-circles c3-circles-virginica"
                                                                        style="cursor: pointer;"></g>
                                                                </g>
                                                            </g>
                                                            <g class="c3-chart-arcs"
                                                                transform="translate(137.6640625,128)"><text
                                                                    class="c3-chart-arcs-title"
                                                                    style="text-anchor: middle; opacity: 1;">Iris Petal
                                                                    Width</text>
                                                                <g class="c3-chart-arc c3-target c3-target-setosa">
                                                                    <g
                                                                        class=" c3-shapes c3-shapes-setosa c3-arcs c3-arcs-setosa">
                                                                        <path
                                                                            class=" c3-shape c3-shape c3-arc c3-arc-setosa"
                                                                            transform=""
                                                                            style="fill: rgba(237, 28, 36, 0.6); cursor: pointer;"
                                                                            d="M-50.646129990800425,-110.55102675667443A121.6,121.6,0,0,1,-1.3034005345198293e-13,-121.6L-7.820403207118977e-14,-72.96A72.96,72.96,0,0,0,-30.387677994480253,-66.33061605400465Z">
                                                                        </path>
                                                                    </g><text dy=".35em"
                                                                        style="opacity: 1; text-anchor: middle; pointer-events: none;"
                                                                        class=""
                                                                        transform="translate(-20.734937830731123,-95.04451984809916)">6.8%</text>
                                                                </g>
                                                                <g class="c3-chart-arc c3-target c3-target-versicolor">
                                                                    <g
                                                                        class=" c3-shapes c3-shapes-versicolor c3-arcs c3-arcs-versicolor">
                                                                        <path
                                                                            class=" c3-shape c3-shape c3-arc c3-arc-versicolor"
                                                                            transform=""
                                                                            style="fill: rgb(88, 216, 163); cursor: pointer;"
                                                                            d="M-46.95087889769887,112.17029451121903A121.6,121.6,0,0,1,-50.646129990800425,-110.55102675667443L-30.387677994480253,-66.33061605400465A72.96,72.96,0,0,0,-28.170527338619323,67.30217670673142Z">
                                                                        </path>
                                                                    </g><text dy=".35em"
                                                                        style="opacity: 1; text-anchor: middle; pointer-events: none;"
                                                                        class=""
                                                                        transform="translate(-97.26661346324175,1.6137860429177646)">36.9%</text>
                                                                </g>
                                                                <g class="c3-chart-arc c3-target c3-target-virginica">
                                                                    <g
                                                                        class=" c3-shapes c3-shapes-virginica c3-arcs c3-arcs-virginica">
                                                                        <path
                                                                            class=" c3-shape c3-shape c3-arc c3-arc-virginica"
                                                                            transform=""
                                                                            style="fill: rgba(4, 189, 254, 0.6); cursor: pointer;"
                                                                            d="M7.445852538815907e-15,-121.6A121.6,121.6,0,1,1,-46.95087889769887,112.17029451121903L-28.170527338619323,67.30217670673142A72.96,72.96,0,1,0,4.467511523289544e-15,-72.96Z">
                                                                        </path>
                                                                    </g><text dy=".35em"
                                                                        style="opacity: 1; text-anchor: middle; pointer-events: none;"
                                                                        class=""
                                                                        transform="translate(95.37541454704433,19.15538305488682)">56.3%</text>
                                                                </g>
                                                            </g>
                                                            <g class="c3-chart-texts">
                                                                <g class="c3-chart-text c3-target c3-target-setosa"
                                                                    style="opacity: 1; pointer-events: none;">
                                                                    <g class=" c3-texts c3-texts-setosa"></g>
                                                                </g>
                                                                <g class="c3-chart-text c3-target c3-target-versicolor"
                                                                    style="opacity: 1; pointer-events: none;">
                                                                    <g class=" c3-texts c3-texts-versicolor"></g>
                                                                </g>
                                                                <g class="c3-chart-text c3-target c3-target-virginica"
                                                                    style="opacity: 1; pointer-events: none;">
                                                                    <g class=" c3-texts c3-texts-virginica"></g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g clip-path="url(https://themewagon.github.io/themekit/?_ga=2.185235305.151776487.1685172181-2118687564.1682662673#c3-1685261310890-clip-grid)"
                                                            class="c3-grid c3-grid-lines">
                                                            <g class="c3-xgrid-lines"></g>
                                                            <g class="c3-ygrid-lines"></g>
                                                        </g>
                                                        <g class="c3-axis c3-axis-x"
                                                            clip-path="url(https://themewagon.github.io/themekit/?_ga=2.185235305.151776487.1685172181-2118687564.1682662673#c3-1685261310890-clip-xaxis)"
                                                            transform="translate(0,266)"
                                                            style="visibility: visible; opacity: 0;"><text
                                                                class="c3-axis-x-label" transform=""
                                                                style="text-anchor: end;" x="275.328125" dx="-0.5em"
                                                                dy="-0.5em"></text>
                                                            <g class="tick" transform="translate(3, 0)"
                                                                style="opacity: 1;">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em" dx="0">0
                                                                    </tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(9, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">1
                                                                    </tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(14, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">2
                                                                    </tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(20, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">3
                                                                    </tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(25, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">4
                                                                    </tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(31, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">5
                                                                    </tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(36, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em" dx="0">6
                                                                    </tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(42, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">7
                                                                    </tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(47, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">8
                                                                    </tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(53, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">9
                                                                    </tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(58, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        10</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(64, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        11</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(69, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        12</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(75, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        13</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(80, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        14</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(86, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        15</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(91, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        16</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(97, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        17</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(102, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        18</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(108, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        19</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(113, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        20</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(119, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        21</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(124, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        22</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(130, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        23</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(135, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        24</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(141, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        25</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(146, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        26</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(152, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        27</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(157, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        28</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(163, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        29</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(168, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        30</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(174, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        31</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(179, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        32</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(185, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        33</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(190, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        34</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(196, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        35</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(202, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        36</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(207, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        37</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(213, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        38</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(218, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        39</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(224, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        40</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(229, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        41</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(235, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        42</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(240, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        43</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(246, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        44</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(251, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        45</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(257, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        46</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(262, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        47</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(268, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em" dx="0">
                                                                        48</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(273, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9" transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">49</tspan>
                                                                </text>
                                                            </g>
                                                            <path class="domain" d="M0,6V0H275.328125V6"></path>
                                                        </g>
                                                        <g class="c3-axis c3-axis-y"
                                                            clip-path="url(https://themewagon.github.io/themekit/?_ga=2.185235305.151776487.1685172181-2118687564.1682662673#c3-1685261310890-clip-yaxis)"
                                                            transform="translate(0,0)"
                                                            style="visibility: visible; opacity: 0;"><text
                                                                class="c3-axis-y-label" transform="rotate(-90)"
                                                                style="text-anchor: end;" x="0"
                                                                dx="-0.5em" dy="1.2em"></text>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,254)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">0</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,235)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">0.2</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,217)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">0.4</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,198)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">0.6</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,180)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">0.8</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,162)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">1</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,143)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">1.2</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,125)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">1.4</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,106)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">1.6</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,88)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">1.8</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,70)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">2</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,51)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">2.2</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,33)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">2.4</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(0,14)">
                                                                <line x2="-6"></line><text x="-9"
                                                                    y="0" style="text-anchor: end;">
                                                                    <tspan x="-9" dy="3">2.6</tspan>
                                                                </text>
                                                            </g>
                                                            <path class="domain" d="M-6,1H0V266H-6"></path>
                                                        </g>
                                                        <g class="c3-axis c3-axis-y2"
                                                            transform="translate(275.328125,0)"
                                                            style="visibility: hidden; opacity: 0;"><text
                                                                class="c3-axis-y2-label" transform="rotate(-90)"
                                                                style="text-anchor: end;" x="0"
                                                                dx="-0.5em" dy="-0.5em"></text>
                                                            <g class="tick" transform="translate(0,266)"
                                                                style="opacity: 1;">
                                                                <line x2="6"></line><text x="9"
                                                                    y="0" style="text-anchor: start;">
                                                                    <tspan x="9" dy="3">0</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" transform="translate(0,240)"
                                                                style="opacity: 1;">
                                                                <line x2="6"></line><text x="9"
                                                                    y="0" style="text-anchor: start;">
                                                                    <tspan x="9" dy="3">0.1</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" transform="translate(0,213)"
                                                                style="opacity: 1;">
                                                                <line x2="6"></line><text x="9"
                                                                    y="0" style="text-anchor: start;">
                                                                    <tspan x="9" dy="3">0.2</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" transform="translate(0,187)"
                                                                style="opacity: 1;">
                                                                <line x2="6"></line><text x="9"
                                                                    y="0" style="text-anchor: start;">
                                                                    <tspan x="9" dy="3">0.3</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" transform="translate(0,160)"
                                                                style="opacity: 1;">
                                                                <line x2="6"></line><text x="9"
                                                                    y="0" style="text-anchor: start;">
                                                                    <tspan x="9" dy="3">0.4</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" transform="translate(0,134)"
                                                                style="opacity: 1;">
                                                                <line x2="6"></line><text x="9"
                                                                    y="0" style="text-anchor: start;">
                                                                    <tspan x="9" dy="3">0.5</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" transform="translate(0,107)"
                                                                style="opacity: 1;">
                                                                <line x2="6"></line><text x="9"
                                                                    y="0" style="text-anchor: start;">
                                                                    <tspan x="9" dy="3">0.6</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" transform="translate(0,81)"
                                                                style="opacity: 1;">
                                                                <line x2="6"></line><text x="9"
                                                                    y="0" style="text-anchor: start;">
                                                                    <tspan x="9" dy="3">0.7</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" transform="translate(0,54)"
                                                                style="opacity: 1;">
                                                                <line x2="6"></line><text x="9"
                                                                    y="0" style="text-anchor: start;">
                                                                    <tspan x="9" dy="3">0.8</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" transform="translate(0,28)"
                                                                style="opacity: 1;">
                                                                <line x2="6"></line><text x="9"
                                                                    y="0" style="text-anchor: start;">
                                                                    <tspan x="9" dy="3">0.9</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" transform="translate(0,1)"
                                                                style="opacity: 1;">
                                                                <line x2="6"></line><text x="9"
                                                                    y="0" style="text-anchor: start;">
                                                                    <tspan x="9" dy="3">1</tspan>
                                                                </text>
                                                            </g>
                                                            <path class="domain" d="M6,1H0V266H6"></path>
                                                        </g>
                                                    </g>
                                                    <g transform="translate(0.5,320.5)" style="visibility: hidden;">
                                                        <g clip-path="url(https://themewagon.github.io/themekit/?_ga=2.185235305.151776487.1685172181-2118687564.1682662673#c3-1685261310890-clip-subchart)"
                                                            class="c3-chart">
                                                            <g class="c3-chart-bars"></g>
                                                            <g class="c3-chart-lines"></g>
                                                        </g>
                                                        <g clip-path="url(https://themewagon.github.io/themekit/?_ga=2.185235305.151776487.1685172181-2118687564.1682662673#c3-1685261310890-clip)"
                                                            class="c3-brush" fill="none" pointer-events="all"
                                                            style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                                            <rect class="overlay" pointer-events="all"
                                                                cursor="crosshair" x="0" y="0"
                                                                width="275.328125" height="0"></rect>
                                                            <rect class="selection" cursor="move" fill="#777"
                                                                fill-opacity="0.3" stroke="#fff"
                                                                shape-rendering="crispEdges" style="display: none;">
                                                            </rect>
                                                            <rect class="handle handle--e" cursor="ew-resize"
                                                                style="display: none;"></rect>
                                                            <rect class="handle handle--w" cursor="ew-resize"
                                                                style="display: none;"></rect>
                                                        </g>
                                                        <g class="c3-axis-x" transform="translate(0,0)"
                                                            clip-path="url(https://themewagon.github.io/themekit/?_ga=2.185235305.151776487.1685172181-2118687564.1682662673#c3-1685261310890-clip-xaxis)"
                                                            style="opacity: 0;">
                                                            <g class="tick" transform="translate(3, 0)"
                                                                style="opacity: 1;">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">0</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(9, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">1</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(14, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">2</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(20, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">3</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(25, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">4</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(31, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">5</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(36, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">6</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(42, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">7</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(47, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">8</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(53, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">9</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(58, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">10</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(64, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">11</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(69, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">12</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(75, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">13</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(80, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">14</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(86, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">15</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(91, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">16</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(97, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">17</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(102, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">18</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(108, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">19</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(113, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">20</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(119, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">21</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(124, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">22</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(130, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">23</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(135, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">24</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(141, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">25</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(146, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">26</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(152, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">27</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(157, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">28</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(163, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">29</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(168, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">30</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(174, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">31</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(179, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">32</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(185, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">33</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(190, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">34</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(196, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">35</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(202, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">36</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(207, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">37</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(213, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">38</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(218, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">39</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(224, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">40</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(229, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">41</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(235, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">42</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(240, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">43</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(246, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">44</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(251, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">45</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(257, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">46</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(262, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">47</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(268, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: block;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">48</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="tick" style="opacity: 1;"
                                                                transform="translate(273, 0)">
                                                                <line x1="0" x2="0" y2="6">
                                                                </line><text x="0" y="9"
                                                                    transform=""
                                                                    style="text-anchor: middle; display: none;">
                                                                    <tspan x="0" dy=".71em"
                                                                        dx="0">49</tspan>
                                                                </text>
                                                            </g>
                                                            <path class="domain" d="M0,6V0H275.328125V6"></path>
                                                        </g>
                                                    </g>
                                                    <g transform="translate(0,300)">
                                                        <g class="c3-legend-item c3-legend-item-setosa"
                                                            style="visibility: visible; cursor: pointer; opacity: 1;">
                                                            <text x="51.9775390625" y="9"
                                                                style="pointer-events: none;">setosa</text>
                                                            <rect class="c3-legend-item-event" x="37.9775390625"
                                                                y="-5" style="fill-opacity: 0;"
                                                                width="60.681640625" height="18"></rect>
                                                            <line class="c3-legend-item-tile" x1="35.9775390625"
                                                                y1="4" x2="45.9775390625" y2="4"
                                                                stroke-width="10"
                                                                style="stroke: rgba(237, 28, 36, 0.6); pointer-events: none;">
                                                            </line>
                                                        </g>
                                                        <g class="c3-legend-item c3-legend-item-versicolor"
                                                            style="visibility: visible; cursor: pointer; opacity: 1;">
                                                            <text x="112.6591796875" y="9"
                                                                style="pointer-events: none;">versicolor</text>
                                                            <rect class="c3-legend-item-event" x="98.6591796875"
                                                                y="-5" style="fill-opacity: 0;"
                                                                width="78.349609375" height="18"></rect>
                                                            <line class="c3-legend-item-tile" x1="96.6591796875"
                                                                y1="4" x2="106.6591796875" y2="4"
                                                                stroke-width="10"
                                                                style="stroke: rgb(88, 216, 163); pointer-events: none;">
                                                            </line>
                                                        </g>
                                                        <g class="c3-legend-item c3-legend-item-virginica"
                                                            style="visibility: visible; cursor: pointer; opacity: 1;">
                                                            <text x="191.0087890625" y="9"
                                                                style="pointer-events: none;">virginica</text>
                                                            <rect class="c3-legend-item-event" x="177.0087890625"
                                                                y="-5" style="fill-opacity: 0;"
                                                                width="60.341796875" height="18"></rect>
                                                            <line class="c3-legend-item-tile" x1="175.0087890625"
                                                                y1="4" x2="185.0087890625" y2="4"
                                                                stroke-width="10"
                                                                style="stroke: rgba(4, 189, 254, 0.6); pointer-events: none;">
                                                            </line>
                                                        </g>
                                                    </g><text class="c3-title" x="137.6640625" y="0"></text>
                                                </svg>
                                                <div class="c3-tooltip-container"
                                                    style="position: absolute; pointer-events: none; display: none; top: 49.9844px; left: 61.8438px;">
                                                    <table class="c3-tooltip">
                                                        <tbody>
                                                            <tr class="c3-tooltip-name--versicolor">
                                                                <td class="name"><span
                                                                        style="background-color:rgba(88,216,163,1)"></span>versicolor
                                                                </td>
                                                                <td class="value">36.9%</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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
        </div>
    </div>
@endsection
