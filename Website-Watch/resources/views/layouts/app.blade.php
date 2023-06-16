<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'TC Watch ')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- Styles elemnt  --}}
    <link href="/css/style.css" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.css"
        integrity="sha512-qveKnGrvOChbSzAdtSs8p69eoLegyh+1hwOMbmpCViIwj7rn4oJjdmMvWOuyQlTOZgTlZA0N2PXA7iA8/2TUYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    {{-- Add Sweetalert library --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        //Pass Header Token
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let _token = $('meta[name="csrf-token"]').attr("content");
    </script>
     <script type="text/javascript" src="{{ asset('js/doctien.js') }}"></script>
    {{-- Add file handling user login  --}}
    <script type="text/javascript" src="{{ asset('js/Customer/login-user.js') }}"></script>
    {{-- Add file to handle user registration  --}}
    <script type="text/javascript" src="{{ asset('js/Customer/register-user.js') }}"></script>
    {{-- Add a file to hide or show the password --}}
    <script type="text/javascript" src="{{ asset('js/Customer/hidden-show-pass.js') }}"></script>
    {{-- Add product search processing file --}}
    <script type="text/javascript" src="{{ asset('js/Customer/search-product.js') }}"></script>
    {{-- Add add to cart processing file --}}
    <script type="text/javascript" src="{{ asset('js/Customer/add-to-cart.js') }}"></script>
    {{-- Add remove item cart processing file --}}
    <script type="text/javascript" src="{{ asset('js/Customer/remove-pro-cart.js') }}"></script>
    {{-- Add comment product processing file --}}
    <script type="text/javascript" src="{{ asset('js/Customer/comment-product.js') }}"></script>
    {{-- Add like product processing file --}}
    <script type="text/javascript" src="{{ asset('js/Customer/like-product.js') }}"></script>
    {{-- Add buy product processing file --}}
    <script type="text/javascript" src="{{ asset('js/Customer/buy-product.js') }}"></script>
    {{-- Add setting profile user processing file --}}
    <script type="text/javascript" src="{{ asset('js/Customer/setting-profile-user.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style type="text/css">
        #btn-back-to-top {
            position: fixed;
            bottom: 70px;
            right: 20px;
            display: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $('.shopping-cart').animate({
                    marginLeft: "-=5px",
                    marginTop: "-=5px"
                }, 500);
                $('.shopping-cart').animate({
                    marginLeft: "+=5px",
                    marginTop: "+=5px"
                }, 500)
            }, 100);
        });
    </script>

</head>

<body>
    <div class="header sticky-top" id="header">
        <form action="" method="post">
            <div class="header-contact">
                <div class="container">
                    <div class="row">
                        <div class="left col-6 row">
                            <div class="header-icon col-2">
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                            <div class="header-add col-10">
                                <a href="{{ url('/') }}">
                                    <p class="">
                                        <i id="iconhouse" class="fas fa-home"></i>
                                        <strong>SHOP: </strong>123 Nguyễn Tất Thành, Nha Trang, Khánh Hòa
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="center col-2">
                        </div>
                        <div class="right col-4 ">

                            <p class="">
                                <i id="iconphone" class="fas fa-phone-volume"></i>
                                <strong>HOTLINE: </strong>038 655 5555 |
                                @guest
                                    <button type="button" class="button" data-bs-toggle="modal"
                                        data-bs-target="#login">Đăng nhập</button> &nbsp;
                                    <button type="button" class="button" data-bs-toggle="modal"
                                        data-bs-target="#signup">Đăng ký</button>
                                @else
                                    <a href="/thong-tin-ca-nhan" style="color:white;font-size: 18px;"><i
                                            class="fas fa-user-cog"></i></a>
                                    <strong></strong>
                                    {{ $nameUser }}
                                    <input type="hidden" id="ID-User" value="{{ Auth::user()->id }}">
                                    <button type="button" name="logout" class="btn btn-dark"><a
                                            href="{{ url('api/logout-user') }}" style="color:#f1f1f1"><i
                                                class="fas fa-sign-out-alt"></i></a></button>
                                @endguest
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="header-menu " id="header-menu">
            <div class="container">
                <div class="row">
                    <div class="col-5 menu">
                        <nav class="navbar navbar-expand-lg ">
                            <div class="container-fluid">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <button class="btn float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"
                                    role="button" style="margin-bottom: 5px;">
                                    <i class="bi bi-arrow-right-square-fill fs-3" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvas"><i style="font-size: 25px;"
                                            class="fa-solid fa-screwdriver-wrench"></i></i>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="{{ url('/') }}">TRANG
                                                CHỦ</a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link" href="#">TIN TỨC</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                NAM
                                            </a>
                                            <ul class="dropdown-menu">
                                                <!-- duyệt các hãng thuộc giới tính nam, thẻ a có đường dẫn tới file shop chứa brand, giới tính tương tứng -->
                                                @foreach ($brandMenu['men'] as $value)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="/shop?gender%5Bnam%5D=on&brand%5B{{ $value->brand }}%5D=on">{{ $value->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                NỮ
                                            </a>
                                            <ul class="dropdown-menu">
                                                <!-- duyệt các hãng thuộc giới tính nữ, thẻ a có đường dẫn tới file shop chứa brand, giới tính tương tứng -->

                                                @foreach ($brandMenu['women'] as $value)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="/shop?gender%5Bnu%5D=on&brand%5B{{ $value->brand }}%5D=on">{{ $value->name }}</a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">LIÊN HỆ</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="logo col-2">
                        <img id="logo" src="{{ asset('images/tcwlogo.png') }}" alt="" srcset="">
                    </div>
                    <div class="col-5 row right searchbtn">
                        <div class="col-7 search">
                            <div class="input-group">
                                <div id="search-autocomplete" class="form-outline">
                                    <input type="search" id="search-product" class="form-control"
                                        placeholder="Tìm kiếm..." />
                                </div>
                                <button type="button" class="btn"
                                    style="border-bottom-right-radius: 10px;border-top-right-radius: 10px;">
                                    <i class="fa fa-search"></i>
                                </button>
                                <div id="searchResult" class="dropdown-content dWSearchResult showSearchResult">
                                    <!-- hiển thị kết quả tìm kiếm sản phẩm -->

                                </div>
                            </div>
                        </div>
                        <div class="col-5 cartbtn">
                            <ul class="navbar-nav">
                                <li class="nav-item show_history_cart">
                                    <a href="{{ url('/gio-hang') }}" id="show_history_cart" class="nav-link">
                                        <span class="header-cart-title">GIỎ HÀNG
                                            <i style="" class="fas fa-cart-plus  shopping-cart"></i>
                                            <span style="position: absolute;top: 0%;color:white;">
                                                <p id="quantity-shopping-cart">{{ count((array) session('cart')) }}
                                                </p>
                                            </span>
                                        </span>
                                    </a>
                                    <div class="dropdown">
                                        <div class="dropdown-content">
                                            <a class="dropdown-item" href="/lich-su-dat-hang">Lịch
                                                sử đặt hàng</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- add file menu (is header) --}}
    {{-- @include('layouts.menu') --}}
    <main class="">
        @yield('content')
    </main>
    <div class="footer ">
        <div class="container">
            <div class="wrapper">
                <div class="ring">
                    <a href="tel:+840386555555">
                        <div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show">
                            <div class="coccoc-alo-ph-circle"></div>
                            <div class="coccoc-alo-ph-circle-fill"></div>
                            <div class="coccoc-alo-ph-img-circle"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12 mt-5">
                    <img class="logo" src="{{ asset('images/tcwlogo.png') }}" alt="" srcset="">
                    <table>
                        <tr>
                            <td><i class="fas fa-map-marker-alt"></i></td>
                            <td>123 Nguyễn Tất Thành, Nha Trang, Khánh Hòa</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-phone-volume"></i> </td>
                            <td>038 655 5555 </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-envelope"></i></td>
                            <td>tcwatch.nhatrang@gmail.com</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 col-sm-6 mt-5">
                    <h2>Đăng ký</h2>
                    <p>Đăng ký để nhận được được thông tin mới nhất từ chúng tôi.</p>
                    <input type="text" placeholder="Email ..."><i class="fas fa-paper-plane"
                        id="plane"></i></i>
                    <h2>Kết nối với chúng tôi</h2>
                    <div>
                        <a href="#" class="iconfaw">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="iconfaw">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="iconfaw">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-11 copy-right">
                    <i>Copyright ©2023 Tất cả các quyền | Mẫu này được thực hiện bởi #TeamTCWatch</i>
                </div>
                <div class=" col-1 back-top" style="display: block;">
                    <a title="Go to top" href="#">
                        <i class="fa fa-circle-chevron-up" id="back-top"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
        <i class="fas fa-arrow-up"></i> Trở lên
    </button>
    {{-- <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div> --}}
    @include('modal/login_register')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    {{-- Add js handle carousel slick --}}
    <script type="text/javascript" src="{{ asset('js/slick-carousel.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/simple.money.format.js"></script>
    @stack('scripts')
    <script type="text/javascript">
        let mybutton = document.getElementById("btn-back-to-top");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        mybutton.addEventListener("click", backToTop);

        function backToTop() {
            console.log(mybutton);
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
</body>

</html>
