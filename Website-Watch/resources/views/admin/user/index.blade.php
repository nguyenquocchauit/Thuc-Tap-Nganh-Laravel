@extends('admin.layout.master')
@section('body')
    <!-- Main -->
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
                            <strong>Xem</strong>, tạo, sửa, xóa, và xóa.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="./admin/customer/create" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Tạo
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        <form>
                            <div class="input-group">
                                <input type="search" name="search" id="search" placeholder="Tên, email, SĐT, địa chỉ"
                                    class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>&nbsp;
                                        Tìm
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Mã khách hàng</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Số điện thoại</th>
                                    <th class="text-center">Địa chỉ</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Vai trò</th>
                                    <th class="text-center">Hành động</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $key=>$customer)
                                    <tr>
                                        <td class="text-center">{{ $key +1 }}</td>
                                        <td class="text-center">{{ $customer->id }}</td>
                                        <td class="text-center">{{ $customer->name }}</td>
                                        <td class="text-center">{{ $customer->phone_number }}</td>
                                        <td class="text-center">
                                            @if ($customer->address == null)
                                                <div class="badge badge-warning mt-2">
                                                    <span>Chưa điền địa chỉ</span>
                                                </div>
                                            @else
                                                {{ $customer->address }}
                                            @endif

                                        </td>

                                        <td class="text-center">
                                            {{ $customer->email }}
                                        </td>

                                        <td class="text-center">
                                            <p>Khách hàng</p>
                                        </td>

                                        <td class="text-center">
                                            <a href="/admin/customer/{{ $customer->id }}/edit" data-toggle="tooltip"
                                                title="Chỉnh sửa" data-placement="bottom"
                                                class="btn btn-outline-warning border-0 btn-sm">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-edit fa-w-20"></i>
                                                </span>
                                            </a>
                                            <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm btn-delete-customer"
                                                type="submit" data-toggle="tooltip" title="Delete" data-placement="bottom">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-trash fa-w-20"></i>
                                                </span>
                                                <input type="hidden" name="" value="{{ $customer->id }}">
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block card-footer">
                        {!! $customers->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
