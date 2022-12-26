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
                                    Sản phẩm
                                    <div class="page-title-subheading">
                                       <strong>Xem</strong>, tạo, sửa, xóa và quản lý. 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                        <li class="nav-item">
                            <a href="./admin/product/{{$product->id}}/edit" class="nav-link">
                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                    <i class="fa fa-edit fa-w-20"></i>
                                </span>
                                <span>Chỉnh sửa</span>
                            </a>
                        </li>

                        <li class="nav-item delete">
                            <form action="./admin/product/ {{ $product->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="nav-link btn" type="submit"
                                    onclick="return confirm('Bạn có thực sự muốn xóa sản phẩm này?')">
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
                                        <label for="name" class="col-md-3 text-md-right col-form-label">Tên sản phẩm</label>
                                        <div class="col-md-9 col-xl-8">
                                           <p>{{$product->name}}</p>
                                        </div>
                                    </div>


                                    <div class="position-relative row form-group">
                                        <label for="brand_id"
                                            class="col-md-3 text-md-right col-form-label">Hãng</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$product->brand}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="product_category_id"
                                            class="col-md-3 text-md-right col-form-label">Loại</label>
                                        <div class="col-md-9 col-xl-8">
                                            @if ($product->gender == 0)
                                            <p>Nam</p>
                                            @else
                                            <p>Nữ</p>
                                            @endif
                                        </div>
                                    </div>
                        


                                    <div class="position-relative row form-group">
                                        <label for="price"
                                            class="col-md-3 text-md-right col-form-label">Giá</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{number_format($product->price)}} VNĐ</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="discount"
                                            class="col-md-3 text-md-right col-form-label">Giảm giá</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$product->discount}}%</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="qty"
                                            class="col-md-3 text-md-right col-form-label">Số lượng kho</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$product->quantity}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="" class="col-md-3 text-md-right col-form-label">Ảnh</label>
                                        <div class="col-md-9 col-xl-8">
                                            <ul class="text-nowrap overflow-auto" id="images">
                                                <li class="d-inline-block mr-1" style="position: relative;">
                                                    <img style="height: 150px;" 
                                                    src="{{ asset('images/image_products_home/') }}/{{ $product->productImage['image_1'] }}"
                                                        alt="Image">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="position-relative row form-group">
                                        <label for="description"
                                            class="col-md-3 text-md-right col-form-label">Mô tả</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$product->description}}</p>
                                        </div>
                                    </div>

                                    <a href="./admin/product" class="btn btn-link">
                                        <span>Quay lại</span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Main -->
@endsection