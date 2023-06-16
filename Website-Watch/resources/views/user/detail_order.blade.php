@extends('layouts.app')
@section('content')
    <div class="purchase-history">
        <section class="intro mt-2 mb-5">
            <div class="bg-image h-100" style="background-color: #f5f7fa;">
                <div class="mask d-flex align-items-center h-100">
                    <div class="container-fluid">
                        <strong class=" d-flex justify-content-center"
                            style="font-size: 30px; font-family: 'Oswald', sans-serif;">LỊCH SỬ MUA HÀNG CỦA BẠN </strong>
                        <div class="row justify-content-center">
                            <div class="col-9">
                                <div class="card shadow-2-strong">
                                    <div class="card-body p-0">
                                        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true"
                                            style="position: relative;">
                                            <table class="table table-dark mb-0 text-center">
                                                <thead style="background-color: #393939;">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" colspan="7">Chi tiết đơn hàng
                                                        </th>
                                                    </tr>
                                                    <tr class="text-uppercase text-success">
                                                        <th scope="col">STT</th>
                                                        <th scope="col">Sản phẩm</th>
                                                        <th scope="col">Ảnh</th>
                                                        <th scope="col">Giá</th>
                                                        <th scope="col">Số lượng</th>
                                                        <th scope="col">Thành tiền</th>
                                                        <th scope="col">Đánh giá</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $detail_total = 0;
                                                    @endphp
                                                    @foreach ($details as $key => $detail)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $detail->product_name }}</td>
                                                            <td>
                                                                <img width="20px" height="30px"
                                                                    src="{{ asset('images/image_products_home/') }}/{{ $detail->image_1 }}"
                                                                    alt="">
                                                            </td>
                                                            <td>{{ number_format($detail->detail_price) . ' VNĐ' }}</td>
                                                            <td>{{ $detail->detail_quantity }}</td>
                                                            <td>{{ number_format($detail->detail_total) . ' VNĐ' }}</td>
                                                            @php
                                                                $detail_total += $detail->detail_total;
                                                            @endphp
                                                            @if ($orders[0]->status == 'TC')
                                                                <td>
                                                                    <a href="/chi-tiet-san-pham/{{ $detail->product_id }}"
                                                                        data-toggle="tooltip" title="Đánh giá" target="_blank"
                                                                        data-placement="bottom"
                                                                        class="btn btn-outline-warning border-0 btn-sm">
                                                                        <span class="btn-icon-wrapper opacity-8">
                                                                            <i class="fa fa-edit fa-w-20"></i>
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                            @else
                                                                <td></td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card card-detail-order ">
                                    <div class="card-header text-center">
                                        <h5 class="mb-0"><strong>Thông tin</strong></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-6"><strong>Mã đơn hàng:</strong></div>
                                                <div class="col-6">
                                                    <h6><strong>{{ $id }}</strong></h6>
                                                    <input type="hidden" value="{{ $id }}" id="id-detail-order">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6"><strong>Địa chỉ giao:</strong></div>
                                                <div class="col-6">
                                                    <h6><strong>{{ $orders[0]->delivery_address }}</strong></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6"><strong>Tình trạng:</strong></div>
                                                <div class="col-6">
                                                    <h6>
                                                        @if ($orders[0]->status == 'XN')
                                                            <strong>Chưa xác nhận</strong>
                                                        @endif
                                                        @if ($orders[0]->status == 'DVC')
                                                            <strong style="color: blue">Đang vận chuyển</strong>
                                                        @endif
                                                        @if ($orders[0]->status == 'TC')
                                                            <strong style="color: green">Thành công</strong>
                                                        @endif
                                                        @if ($orders[0]->status == 'TB')
                                                            <strong style="color: red">Thất bại</strong>
                                                        @endif

                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6"><strong>Ghi chú:</strong></div>
                                                <div class="col-6">
                                                    <h6><strong>{{ $orders[0]->order_notes }}</strong></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6"><strong>Tổng tiền:</strong></div>
                                                <div class="col-6">
                                                    <h5 style="color: red">
                                                        <strong>{{ number_format($orders[0]->total) . ' VNĐ' }}</strong>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3"><strong>Dạng chữ:</strong></div>
                                                <div class="col-9">
                                                    <h6><strong id="dang-chu"></strong></h6>
                                                </div>
                                            </div>
                                            @if ($orders[0]->status == 'XN')
                                                <div class="row">
                                                    <button type="button" class="btn btn-danger btn-block"
                                                        id="cancel-order">
                                                        Hủy đơn hàng</button>
                                                </div>
                                            @endif

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
    <script>
        $(document).ready(function() {
            var docTien = new DocTienBangChu();
            $("#dang-chu").html(docTien.doc({{ $orders[0]->total }}));

        });
    </script>
@endsection
