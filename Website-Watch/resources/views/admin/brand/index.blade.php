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
                        Hãng
                        <div class="page-title-subheading">
                            Xem, tạo, sửa, xóa và <strong>quản lý.</strong>
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="./admin/brand/create" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
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
                                <input type="search" name="search" id="search" placeholder="Nhập tên hãng "
                                    class="form-control" value="{{ request()->search }}">
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
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Slug</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td class="text-center text-muted">{{ $brand->id }}</td>
                                        <td class="text-center text-muted">{{ $brand->name }}</td>
                                        <td class="text-center text-muted">{{ $brand->slug }}</td>
                                        <td class="text-center">

                                            <a href="/admin/brand/{{ $brand->id }}/edit" data-toggle="tooltip"
                                                title="Chỉnh sửa" data-placement="bottom"
                                                class="btn btn-outline-warning border-0 btn-sm">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-edit fa-w-20"></i>
                                                </span>
                                            </a>
                                            <button
                                                class="btn btn-hover-shine btn-outline-danger border-0 btn-sm delete-brand btn-delete-brand"
                                                type="submit" data-toggle="tooltip" title="Delete" data-placement="bottom">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-trash fa-w-20"></i>
                                                </span>
                                                <input type="hidden" name="" value="{{ $brand->id }}">
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block card-footer">
                        {!! $brands->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
