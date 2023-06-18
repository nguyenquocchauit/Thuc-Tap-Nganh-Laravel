@extends('admin.layout.master')
@section('body')
    <div class="content-body">
        <div class="col-sm-12">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                        </div>
                        <div>
                            Thống kê
                            <div class="page-title-subheading">
                               <strong>Khách hàng</strong>, đơn hàng, doanh thu.
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card tabs-card">
                <div class="card-block p-0">
                    <!-- Nav tabs -->
                    <div class="row">
                        <div class="col-12 nav-report-customer">
                            <ul class="nav nav-tabs md-tabs" role="tablist">

                                <li class="nav-item ">
                                    <a class="nav-link a-customer active" data-toggle="tab" href="#customer"
                                        data-id="customer" role="tab"><i class="fa fa-table">
                                        </i>&nbsp;Khách hàng</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item"></li>
                                <li class="nav-item">
                                    <form id="time-report" action="" method="GET">
                                        <div class="row">
                                            <div class="col-6 d-flex justify-content-end">
                                                <input type="date" class="form-control" id="start_day" name="start_day"
                                                    lang="vi" value="{{ request()->start_day }}" />
                                                <input type="date" class="form-control" id="end_day" name="end_day"
                                                    lang="vi" value="{{ request()->end_day }}" />
                                            </div>
                                            <div class="col-6 input-group d-flex justify-content-center">
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
                        <div class="tab-pane active" id="customer" data-id="a-customer"role="tabpanel">
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

        });
    </script>
@endsection
