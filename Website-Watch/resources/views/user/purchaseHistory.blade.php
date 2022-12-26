@extends('layouts.app')
@section('content')
    <div class="purchase-history">
        <section class="intro mt-2 mb-5">
            <div class="bg-image h-100" style="background-color: #f5f7fa;">
                <div class="mask d-flex align-items-center h-100">
                    <div class="container">
                        <strong class=" d-flex justify-content-center"
                            style="font-size: 30px; font-family: 'Oswald', sans-serif;">LỊCH SỬ ĐẶT HÀNG CỦA BẠN</strong>
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card shadow-2-strong">
                                    <div class="card-body p-0">
                                        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true"
                                            style="position: relative;">
                                            <table class="table table-dark mb-0 text-center">
                                                <thead style="background-color: #393939;">
                                                    <tr class="text-uppercase text-success">
                                                        <th scope="col">STT</th>
                                                        <th scope="col">Sản phẩm</th>
                                                        <th scope="col">Thời gian</th>
                                                        <th scope="col">Số lượng</th>
                                                        <th scope="col">Đơn giá</th>
                                                        <th scope="col">Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $total = 0;
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($orders as $order)
                                                        @php $total += $order->totalOrderDetail @endphp
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td><a href="/chi-tiet-san-pham/{{ $order->id }}" style="color: white;text-decoration: none;">{{ $order->name }}</a></td>
                                                            <td>{{ date('d-m-Y   H:i:s', strtotime($order->bought)) }}</td>
                                                            <td>{{ $order->quantity }}</td>
                                                            <td>{{ number_format($order->priceOrderDetail) . ' VNĐ' }}</td>
                                                            <td>{{ number_format($order->totalOrderDetail) . ' VNĐ' }}</td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td class="text-uppercase text-warning" colspan="5">Tổng tiền
                                                        </td>
                                                        <td class="text-uppercase text-warning" colspan="1">{{ number_format($total) . " VNĐ" }}</td>
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
