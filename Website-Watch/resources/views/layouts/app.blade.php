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
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
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
    {{-- Add file handling user login  --}}
    <script type="text/javascript" src="{{ asset('js/login-user.js') }}"></script>
    {{-- Add file to handle user registration  --}}
    <script type="text/javascript" src="{{ asset('js/register-user.js') }}"></script>
    {{-- Add a file to hide or show the password --}}
    <script type="text/javascript" src="{{ asset('js/hidden-show-pass.js') }}"></script>
    {{-- Add product search processing file --}}
    <script type="text/javascript" src="{{ asset('js/search-product.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


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
                                <a href="../../Website Watch PHP/home.php">
                                    <p class="">
                                        <i id="iconhouse" class="fas fa-home"></i>
                                        <strong>SHOP: </strong>2 Nguyễn Đình Chiểu, Nha Trang, Khánh Hòa
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="center col-2">
                        </div>
                        <div class="right col-4 ">
                            <input type="hidden" id="currentUserHDSD" value="">
                            <input type="hidden" id="currentUserHDSD-home" value="">
                            <p class="">
                                <i id="iconphone" class="fas fa-phone-volume"></i>
                                <strong>HOTLINE: </strong>038 655 5555 |
                                @guest

                                    {{-- <a href="../../Website Watch PHP/customers/Chi-tiet.php"
                                    style="color:white;font-size: 18px;"><i class="fas fa-user-cog"></i></a>
                                <strong></strong>
                                <button type="button" name="logout" class="btn btn-dark"><a href="?logout=1"
                                        style="color:#f1f1f1"><i class="fas fa-sign-out-alt"></i></a></button> --}}
                                    <button type="button" class="button" data-bs-toggle="modal"
                                        data-bs-target="#login">Đăng nhập</button> &nbsp;
                                    <button type="button" class="button" data-bs-toggle="modal"
                                        data-bs-target="#signup">Đăng ký</button>
                                @else
                                    <a href="../../Website Watch PHP/customers/Chi-tiet.php"
                                        style="color:white;font-size: 18px;"><i class="fas fa-user-cog"></i></a>
                                    <strong></strong>
                                    {{ $name }}
                                    <button type="button" name="logout" class="btn btn-dark"><a
                                            href="{{ url('api/getname-user') }}" style="color:#f1f1f1"><i
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
                                            <a class="nav-link" aria-current="page"
                                                href="../../Website Watch PHP/home.php">TRANG CHỦ</a>
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
                                                <li><a class="dropdown-item" href="shop.php?gender=IDM&brand="></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                NỮ
                                            </a>
                                            <ul class="dropdown-menu">
                                                <!-- duyệt các hãng thuộc giới tính nữ, thẻ a có đường dẫn tới file shop chứa brand, giới tính tương tứng -->
                                                <li><a class="dropdown-item" href="shop.php?gender=IDWM&brand="></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="../../Website Watch PHP/contact/contact.php">LIÊN HỆ</a>
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
                                <li class="nav-item ">
                                    <a href="../../Website Watch PHP/product and cart/Gio-Hang.php"
                                        id="show_history_cart" class="nav-link">
                                        <span class="header-cart-title">GIỎ HÀNG
                                            <i style="color: black;" class="fas fa-cart-plus mx-2 shopping-cart"></i>
                                            <span style="position: absolute;top: 0%;color:#b31212;">
                                                <p id="quantity-shopping-cart"></p>
                                            </span>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu " id="dropdown_cart"
                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 42px);">
                                        <li class="dropdown_hidden"><a class="dropdown-item "
                                                href="../../Website Watch PHP/product and cart/Lich-su-dat-hang.php">Lịch
                                                sử đặt hàng</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="">
        @yield('content')
    </main>
    <div class="footer ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 mt-5">
                    <img class="logo" src="{{ asset('images/tcwlogo.png') }}" alt="" srcset="">
                    <table>
                        <tr>
                            <td><i class="fas fa-map-marker-alt"></i></td>
                            <td>2 Nguyễn Đình Chiểu, Nha Trang, Khánh Hòa</td>
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
                    <i>Copyright ©2022 Tất cả các quyền | Mẫu này được thực hiện bởi #TeamTCWatch</i>
                </div>
                <div class=" col-1 back-top" style="display: block;">
                    <a title="Go to top" href="#">
                        <i class="fa fa-circle-chevron-up" id="back-top"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
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
</body>

</html>
