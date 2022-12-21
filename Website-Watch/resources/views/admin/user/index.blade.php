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
                            Xem, tạo, sửa, xóa và quản lý.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="./admin/user/create" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
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
                                <input type="search" name="search" id="search" placeholder="Tên, sdt, email"
                                    class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>&nbsp;
                                        Tìm
                                    </button>
                                </span>
                            </div>
                        </form>

                        {{-- <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="btn btn-focus">This week</button>
                                <button class="active btn btn-focus">Anytime</button>
                            </div>
                        </div> --}}
                    </div>
                    @include('admin.alert')
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Số điện thoại</th>
                                    <th class="text-center">Địa chỉ</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Vai trò</th>
                                    <th class="text-center">Hành động</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $user->id }}</td>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->phone_number }}</td>
                                        <td class="text-center">
                                            @if ($user->address == null)
                                                <div class="badge badge-warning mt-2">
                                                    <span>chưa điền địa chỉ</span>
                                                </div>
                                            @else
                                                {{ $user->address }}
                                            @endif

                                        </td>

                                        <td class="text-center">
                                            {{ $user->email }}
                                        </td>

                                        <td class="text-center">
                                            @if ($user->role == 0)
                                                <p>user</p>
                                            @else
                                            <p>admin</p>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <a href="/admin/user/{{ $user->id }}" data-toggle="tooltip" title="Chi tiết"
                                                data-placement="bottom" class="btn btn-outline-success border-0 btn-sm">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fas fa-info-circle fa-w-20"></i>
                                                </span>
                                            </a>
                                            <a href="/admin/user/{{ $user->id }}/edit" data-toggle="tooltip"
                                                title="Chỉnh sửa" data-placement="bottom"
                                                class="btn btn-outline-warning border-0 btn-sm">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-edit fa-w-20"></i>
                                                </span>
                                            </a>
                                            <form class="d-inline" action="./admin/user/ {{$user->id}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                    type="submit" data-toggle="tooltip" title="Delete"
                                                    data-placement="bottom"
                                                    onclick="return confirm('Bạn có thực sự muốn xóa mục này?')">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="fa fa-trash fa-w-20"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block card-footer">
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
