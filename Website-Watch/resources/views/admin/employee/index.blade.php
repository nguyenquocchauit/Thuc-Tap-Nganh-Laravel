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
                        Nhân viên
                        <div class="page-title-subheading">
                            Xem, tạo, sửa, xóa và <strong>quản lý.</strong>
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="./admin/employee/create" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
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
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Ảnh</th>
                                    <th class="text-center">Số điện thoại</th>
                                    <th class="text-center">Địa chỉ</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Vai trò</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $key=> $employee)
                                    <tr>
                                        <td class="text-center">{{ $key+1 }}</td>
                                        <td class="text-center">{{ $employee->id }}</td>
                                        <td class="text-center">{{ $employee->name }}</td>
                                        <td class="text-center">
                                            <img width="70px" height="70px" class="img-fluid"
                                                style="border-radius: 50%;
                                            border: 5px solid #ffffff;"
                                                src="{{ asset('images/employee/') }}/{{ $employee->avt }}" alt="">
                                        </td>
                                        <td class="text-center">{{ $employee->phone_number }}</td>
                                        <td class="text-center">
                                            @if ($employee->address == null)
                                                <div class="badge badge-warning mt-2">
                                                    <span>Chưa điền địa chỉ</span>
                                                </div>
                                            @else
                                                {{ $employee->address }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $employee->email }}
                                        </td>
                                        <td class="text-center">
                                            @if ($employee->role == '1')
                                                Nhân viên
                                            @else
                                                Quản trị
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (auth()->guard('admin')->user()->role == $employee->role &&
                                                    auth()->guard('admin')->user()->id == $employee->id)
                                                <a href="/admin/thong-tin-ca-nhan" data-toggle="tooltip" title="Chỉnh sửa"
                                                    data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="fa fa-edit fa-w-20"></i>
                                                    </span>
                                                </a>
                                            @else
                                                <a href="/admin/employee/{{ $employee->id }}/edit" data-toggle="tooltip" title="Chỉnh sửa"
                                                    data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="fa fa-edit fa-w-20"></i>
                                                    </span>
                                                </a>
                                            @endif
                                            @if (auth()->guard('admin')->user()->role == '2')
                                                <button
                                                    class="btn btn-hover-shine btn-outline-danger border-0 btn-sm btn-delete-employee"
                                                    type="button" data-toggle="tooltip" title="Delete"
                                                    data-placement="bottom">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="fa fa-trash fa-w-20"></i>
                                                    </span>
                                                    <input type="hidden" value="{{ $employee->id }}">
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="d-block card-footer">
                        {!! $employees->links() !!}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
