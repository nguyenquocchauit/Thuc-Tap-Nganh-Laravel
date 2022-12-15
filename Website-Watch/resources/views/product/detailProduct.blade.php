@extends('layouts.app')
@section('content')
    <div class="body-product-details">
        <div class="bodydetail pt-4 mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <table>
                            <tr>
                                <td colspan="4">
                                    <div class="slide">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="0" class="active btnslide" aria-current="true"
                                                    aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="1" class="btnslide" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="2" class="btnslide" aria-label="Slide 3"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="3" class="btnslide" aria-label="Slide 4"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="4" class="btnslide" aria-label="Slide 5"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="5" class="btnslide" aria-label="Slide 6"></button>
                                            </div>
                                            <div class="carousel-inner">
                                                @foreach ($nameImages as $key => $nameImage)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                        <!-- lấy ảnh đầu tiên trong db đúng đường theo folder sản phẩm, còn lại 5 ảnh khác dùng chung ảnh cat.gif (vì dung lượng ảnh lớn nên cắt bớt) -->
                                                        <img src="{{ asset('images/images-product/') }}/{{ $slugGender }}/{{ $slugBrand }}/{{ $nameImage }}"
                                                            class="d-block w-100" alt="...">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                                <span class="glyphicon carousel-control-prev-icon"
                                                    aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                                <span class="glyphicon  carousel-control-next-icon"
                                                    aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <h3 id="name-product">{{ $product->name }}</h3>
                        <div class="price d-flex "
                            @if ($product->discount == 0) {{ 'style =  justify-content: start; margin: 0px; font-size: 20px;' }} @endif
                            style="font-size: 20px;">
                            @if ($product->discount != 0)
                                <p class="price-pre">
                                    <!-- number_format dùng định dạng số theo kiểu đơn vị tiền tệ -->
                                    {{ number_format($product->price) . ' VNĐ' }}
                                </p>
                            @endif
                            <p style="color: red;font-size: 20px;">
                                <!-- xử lý in giá bán sau khi áp dụng giảm giá -->
                                {{ number_format($product->price - $product->price * ($product->discount / 100)) . ' VNĐ' }}
                            </p>
                            <div class="sale" @if ($product->discount == 0) {{ 'style=opacity:0' }} @endif>
                                <!-- đổi số thập phân sang dạng phần trăm -->
                                {{ '-' . $product->discount . '%' }}
                            </div>
                        </div>
                        <h4>Giới thiệu:</h4>
                        <div>
                            <p>{{ $product->description }}</p>
                        </div>
                        <div class="d-flex ">
                            <div class="">
                                <button type="button" class="btn btn-light detail-add-to-cart " id="order-product"
                                    name="add-to-cart">
                                    <i class="fas fa-cart-plus mx-2 shopping-cart"></i> Đặt mua
                                </button>
                                <input type="hidden" id="productID" value="{{ $product->id }}">
                            </div>
                        </div>
                        <div class="mt-5">
                            <h3>Thanh toán</h3>
                            <table>
                                <tr>
                                    <td><img class="imgpay" src="{{ asset('images/logo-techcombank.jpg') }}"
                                            alt=""></td>
                                    <td><img class="imgpay" src="{{ asset('images/logo-paypal.jpg') }}" alt=""
                                            srcset="">
                                    </td>
                                    <td><img class="imgpay" src="{{ asset('images/logo-techcombank.jpg') }}" alt=""
                                            srcset=""></td>
                                </tr>
                                <tr>
                                    <td><img class="imgpay" src="{{ asset('images/logo-vcb.jpg') }}" alt="">
                                    </td>
                                    <td><img class="imgpay" src="{{ asset('images/logo-techcombank.jpg') }}" alt=""
                                            srcset=""></td>
                                    <td><img class="imgpay" src=" {{ asset('images/logo-mastercard.jpg') }}"
                                            alt=""></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="comment-product">
            <section style="">
                <div class="container  py-5 text-dark">
                    <div class="row " style=" color: white;">
                        <div class="col-md-11 col-lg-9 col-xl-7">
                            <div class="d-flex flex-start p-1">
                                <img class="rounded-circle shadow-1-strong me-3"
                                    src="{{ asset('images/avt-comment.webp') }}" alt="avatar" width="65"
                                    height="65" />
                                <div class="card w-100">
                                    <div class="card-body p-4">
                                        <div class="w-100">
                                            <h5>Viết nhận xét</h5>
                                            <div class="rating">
                                                <input type="radio" name="rating" value="5"
                                                    id="5"><label for="5">☆</label>
                                                <input type="radio" name="rating" value="4"
                                                    id="4"><label for="4">☆</label>
                                                <input type="radio" name="rating" value="3"
                                                    id="3"><label for="3">☆</label>
                                                <input type="radio" name="rating" value="2"
                                                    id="2"><label for="2">☆</label>
                                                <input type="radio" name="rating" value="1"
                                                    id="1"><label for="1">☆</label>
                                            </div>
                                            <div class="form-outline">
                                                <textarea class="form-control" id="textAreaExample" rows="2"></textarea>
                                                <label class="form-label" for="textAreaExample">Nội dung</label>
                                            </div>
                                            <div class="d-flex justify-content-between mt-3">
                                                <button type="button" class="btn btn-success">Hủy</button>
                                                <button type="button" class="btn btn-danger">
                                                    Gửi <i class="fas fa-long-arrow-alt-right ms-1"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($comments as $comment)
                                <div class="d-flex flex-start p-1">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                        src="{{ asset('images/avt-comment.webp') }}" alt="avatar" width="65"
                                        height="65" />
                                    <div class="card w-100">
                                        <div class="card-body p-4">
                                            <div class="">
                                                <h5>{{ $comment->user['name'] }}</h5>
                                                <p class="small">{{$comment->create_at }}</p>
                                                <p>
                                                    {{ $comment->content }}
                                                </p>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <a href="#!" class="link-muted me-2"><i
                                                                class="fas fa-thumbs-up me-1"></i>132</a>
                                                        <a href="#!" class="link-muted"><i
                                                                class="fas fa-thumbs-down me-1"></i>15</a>
                                                    </div>
                                                    <a href="#!" class="link-muted"><i
                                                            class="fas fa-reply me-1"></i>
                                                        Trả lời</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex flex-start p-1">
                                <img class="rounded-circle shadow-1-strong me-3"
                                    src="{{ asset('images/avt-comment.webp') }}" alt="avatar" width="65"
                                    height="65" />
                                <div class="card w-100">
                                    <div class="card-body p-4">
                                        <div class="">
                                            <h5>Mindy Campbell</h5>
                                            <p class="small">5 hours ago</p>
                                            <p>
                                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus
                                                cumque doloribus dolorum dolor repellat nemo animi at iure autem fuga
                                                cupiditate architecto ut quam provident neque, inventore nisi eos quas?
                                            </p>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <a href="#!" class="link-muted me-2"><i
                                                            class="fas fa-thumbs-up me-1"></i>158</a>
                                                    <a href="#!" class="link-muted"><i
                                                            class="fas fa-thumbs-down me-1"></i>13</a>
                                                </div>
                                                <a href="#!" class="link-muted"><i class="fas fa-reply me-1"></i>
                                                    Trả lời</a>
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
    </div>
@endsection
