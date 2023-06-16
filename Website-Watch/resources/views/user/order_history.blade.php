@extends('layouts.app')
@section('content')
    <div class="purchase-history">
        <section class="intro mt-2 mb-5">
            <div class="bg-image h-100" style="background-color: #f5f7fa;">
                <div class="mask d-flex align-items-center h-100">
                    <div class="container-fluid">
                        <strong class=" d-flex justify-content-center"
                            style="font-size: 30px; font-family: 'Oswald', sans-serif;">LỊCH SỬ MUA HÀNG CỦA BẠN</strong>
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card shadow-2-strong">
                                    <div class="card-body p-0">
                                        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true"
                                            style="position: relative;">
                                            <table class="table table-dark mb-0 text-center">
                                                <thead style="background-color: #393939;">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" colspan="7">Đơn hàng</th>
                                                    </tr>
                                                    <tr class="text-uppercase text-success">
                                                        <th scope="col">STT</th>
                                                        <th scope="col">Mã đơn</th>
                                                        <th scope="col">Mua vào ngày</th>
                                                        <th scope="col">Đơn giá</th>
                                                        <th scope="col">Tình trạng</th>
                                                        <th scope="col">Thành tiền</th>
                                                        <th scope="col">Xem chi tiết</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $orders_total=0; @endphp
                                                    @foreach ($orders as $key => $order)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $order->idOrder }}</td>
                                                            <td>{{ $order->created_at }}</td>
                                                            <td>{{ number_format($order->total) . ' VNĐ' }}</td>
                                                            <td>
                                                                @if ($order->status == 'TC')
                                                                    Thành công
                                                                @endif
                                                                @if ($order->status == 'TB')
                                                                    Thất bại
                                                                @endif
                                                                @if ($order->status == 'DVC')
                                                                    Đang vận chuyển
                                                                @endif
                                                                @if ($order->status == 'XN')
                                                                    Chưa xác nhận
                                                                @endif

                                                            </td>
                                                            <td>{{ number_format($order->total) . ' VNĐ' }}</td>
                                                            @php
                                                                if ($order->status == 'TC') {
                                                                    $orders_total += $order->total;
                                                                }
                                                            @endphp
                                                            <td>
                                                                <a href="/lich-su-dat-hang/{{ $order->idOrder }}"
                                                                    data-toggle="tooltip" title="Chi tiết đơn hàng"
                                                                    data-placement="bottom"
                                                                    class="btn btn-outline-success border-0 btn-sm"
                                                                    target="_blank">
                                                                    <span class="btn-icon-wrapper opacity-8">
                                                                        <i class="fas fa-eye fa-w-20"></i>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><strong style="color:yellow">TỔNG TIỀN</strong></td>
                                                        <td><strong
                                                                style="color:yellow">{{ number_format($orders_total) . ' VNĐ' }}</strong>
                                                        </td>
                                                        <td></td>
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
        </section>
    </div>
@endsection
