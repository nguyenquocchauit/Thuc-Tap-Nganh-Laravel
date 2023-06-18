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
                               Khách hàng, đơn hàng, <strong>doanh thu.</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <div class="card gradient-5">
                        <div class="card-body">
                            <h3 class="card-title text-white">Doanh thu</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white revenue "></h2>
                                <input type="hidden" name="" id="revenue" value="{{ $revenue }}">
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
                        <div class="col-12 nav-report-customer">
                            <ul class="nav nav-tabs md-tabs" role="tablist">

                                <li class="nav-item ">
                                    <a class="nav-link a-customer active" data-toggle="tab" href="#customer"
                                        data-id="customer" role="tab"><i class="fa fa-table">
                                        </i>&nbsp;Doanh thu</a>
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
                        <div class="tab-pane active" id="revenues" data-id="a-revenue"role="tabpanel">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Hãng</th>
                                                    <th>Loại</th>
                                                    <th>Số lượng bán</th>
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
                                            <p class="card-title mx-auto">Tỉ lệ % giao hàng thành công/tháng</p>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="sales-chart-c" class="mt-2"></canvas>
                                            <ul class="navbar-nav dashboard-chart-legend">
                                                <li class="nav-item"><span style="background-color: #04fb00 "></span>
                                                    {{ number_format($percentReceived, 1, '.', ',') . '%' }} Thành công</li>
                                                <li class="nav-item"><span style="background-color: #ff4747  "></span>
                                                    {{ number_format($percentFail, 1, '.', ',') . '%' }} Thất bại</li>
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
