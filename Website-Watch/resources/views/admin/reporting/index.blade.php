@extends('admin.layout.master')
@section('body')
    {{-- <!-- Main -->
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Người dùng
                                    <div class="page-title-subheading">
                                        <strong>Xem</strong>, tạo, sửa, xóa và quản lý.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                        <li class="nav-item">
                            <a href="./admin/user/{{$user->id}}/edit" class="nav-link">
                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                    <i class="fa fa-edit fa-w-20"></i>
                                </span>
                                <span>Chỉnh sửa</span>
                            </a>
                        </li>

                        <li class="nav-item delete">
                            <form action="./admin/user/ {{ $user->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="nav-link btn" type="submit"
                                    onclick="return confirm('Bạn có thực sự muốn xóa người dùng này?')">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-trash fa-w-20"></i>
                                    </span>
                                    <span>Xóa</span>
                                </button>
                            </form>
                        </li>
                    </ul>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body display_data">

                                    <div class="position-relative row form-group">
                                        <label for="name" class="col-md-3 text-md-right col-form-label">
                                            Id
                                        </label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$user->id}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="name" class="col-md-3 text-md-right col-form-label">
                                            Tên
                                        </label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$user->name}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="email" class="col-md-3 text-md-right col-form-label">Số điện thoại</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$user->phone_number}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="company_name" class="col-md-3 text-md-right col-form-label">
                                            Địa chỉ
                                        </label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$user->address}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="country"
                                            class="col-md-3 text-md-right col-form-label">Email</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$user->email}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="country"
                                            class="col-md-3 text-md-right col-form-label">Vai trò</label>
                                        <div class="col-md-9 col-xl-8">
                                            @if ($user->role == 0)
                                                người dùng
                                            @else
                                                quản trị viên
                                            @endif
                                        </div>
                                    </div>

                                    <a href="./admin/user" class="btn btn-link">
                                        <span>Quay lại</span>
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Main --> --}}




    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
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
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-4">
                        <div class="card-body">
                            <h3 class="card-title text-white">Đơn hàng đang vận chuyển</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">{{ $shipping }}</h2>
                                <p class="text-white mb-0">
                                    {{ 'Tháng ' . $month . ' - Năm ' . $year }}
                                </p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fas fa-truck"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
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
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-2">
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
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <form id="time-report" action="" method="GET">
                                <div class="col-5 float-right p-2">
                                    <div class="input-group date">
                                        <input type="month" class="form-control" id="time_select" name="time_select" lang="vi" onchange="this.form.submit()" value="{{ request()->time_select }}"  />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-content card-block">
                        <div class="tab-pane active" role="tabpanel">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Ảnh</th>
                                            <th>Khách hàng</th>
                                            <th>Mua vào</th>
                                            <th>Trạng thái</th>
                                            <th>Mã đơn</th>
                                            <th>Nhân viên</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key=> $order)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $order->idProduct }}</td>
                                                <td>
                                                    <img width="25px" height="25px" class="img-fluid"
                                                        src="{{ asset('images/image_products_home/') }}/{{ $order->image }}"
                                                        alt="">
                                                </td>
                                                <td>{{ $order->name_customer }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    @if ($order->status === 'DVC')
                                                        <span class="label label-warning">Đang vận chuyển</span>
                                                    @endif
                                                    @if ($order->status === 'TC')
                                                        <span class="label label-success">Thành công</span>
                                                    @endif
                                                    @if ($order->status === 'TB')
                                                        <span class="label label-danger">Thất bại</span>
                                                    @endif
                                                    @if ($order->status === 'XN')
                                                        <span class="label label-confirm ">Xác nhận</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->idDetail }}</td>
                                                <td>{{ $order->name_employee }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="d-block card-footer">
                                {!! $orders->links() !!}
                            </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
