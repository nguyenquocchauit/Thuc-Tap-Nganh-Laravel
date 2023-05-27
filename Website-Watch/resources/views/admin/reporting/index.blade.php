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
                                {{-- <h2 class="text-white ">{{ number_format($revenue) . ' VNĐ' }}</h2> --}}
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
                                    <a class="nav-link active a-order" data-toggle="tab" href="#order" role="tab"><i
                                            class="fa fa-home">
                                        </i>&nbsp;Đơn hàng</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link a-customer" data-toggle="tab" href="#customer" role="tab"><i
                                            class="fa fa-table">
                                        </i>&nbsp;Khách hàng</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link a-revenues" data-toggle="tab" href="#revenues" role="tab"><i
                                            class="fa fa-table">
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
                                                    value="{{ request()->search }}" placeholder="Mã đơn hàng"
                                                    class="form-control">
                                                <button type="submit" class="btn btn-primary">
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
                                                        <select
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
                                                        <td>{{ date(' H:i:s d-m-Y', strtotime($customer->created_at))  }}</td>
                                                        <td>{{ date(' H:i:s d-m-Y', strtotime($customer->updated_at))  }}</td>
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
                                                    <th>Mã chi tiết đơn</th>
                                                    <th>Mã sản phẩm</th>
                                                    <th>Tên</th>
                                                    <th>Ảnh</th>
                                                </tr>
                                            </thead>
                                            {{-- <tbody>
                                                @foreach ($details as $key => $detail)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $detail->idDetail }}</td>
                                                        <td>
                                                            <a style="color: #006468;"
                                                                href="/chi-tiet-san-pham/{{ $detail->idProduct }}"
                                                                target="_blank">{{ $detail->idProduct }}</a>
                                                        </td>
                                                        <td>{{ $detail->name_product }}</td>
                                                        <td>
                                                            <img width="25px" height="25px" class="img-fluid"
                                                                src="{{ asset('images/image_products_home/') }}/{{ $detail->image }}"
                                                                alt="">
                                                        </td>
                                                        <td>{{ number_format($detail->detail_price) . ' VNĐ' }}</td>
                                                        <td>{{ $detail->detail_discount . '%' }}</td>
                                                        <td>{{ number_format($detail->detail_total) . ' VNĐ' }}</td>


                                                    </tr>
                                                @endforeach
                                            </tbody> --}}
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
@endsection
