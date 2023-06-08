<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Đăng nhập quản trị</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        //Pass Header Token
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let _token = $('meta[name="csrf-token"]').attr("content");
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script type="text/javascript" src="{{ asset('js/Admin/login-admin.js') }}"></script>
    <!-- Scripts -->
    <style>
        * {
            margin: 0;
            padding: 0
        }

        body {
            width: 100%;
            margin: 0 auto;
            max-width: 1350px;
            font-family: 'Oswald', sans-serif;
            background: #F0E4E4;
        }

        .form_hoa {
            width: 40%;
            margin: auto;
        }

        .form_hoa>.box_login {
            width: 100%;
            margin-top: 30%;
            background-color: #d5d5d5;
            box-shadow: 0 0 2px #000;
            border-radius: 10px;
            padding: 20px;
            box-sizing: border-box;
        }

        .box_login form h2 {
            text-align: center;
            color: #000;
            font-size: 30px;
        }

        .box_login form>div {
            padding: 5px 0px;
        }

        .box_login form label {
            padding: 3px 0;
            display: block;
            font-weight: bold;
        }

        .box_login form input {
            width: 100%;
            border: none;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .box_login form button {
            width: 100%;
            border: none;
            background: #333;
            color: #fff;
            padding: 11px;
            border-radius: 5px;
            box-sizing: border-box;
            text-align: center;
            font-size: 20px;
        }

        .form_hoa .box_login #login .row-item .change-pasword-login {
            position: relative;
            left: 94%;
            bottom: 36px;
            cursor: pointer;
        }

        #login-admin {
            cursor: pointer;
        }
    </style>
    <script>
        $(document).ready(function() {
            localStorage.setItem('yourOrderUnconfirm', true);
            if (window.location.href.indexOf("/admin/login") !== -1) {
                localStorage.setItem('yourOrderUnconfirm', false);
            }

            console.log(localStorage.getItem('yourOrderUnconfirm'));

        });
    </script>
</head>

<body>
    <div class="form_hoa">
        <div class="box_login">
            <form action="" method="POST" id="login">
                <h2>Quản Trị TCWatch </h2>
                <div class="row-item">
                    <label for="username">Email<strong style="color: red">*</strong></label>
                    <input type="text" name="username" id="email-login-admin" placeholder="Email" value="" />
                </div>
                <div class="row-item">
                    <label for="password">Mật khẩu<strong style="color: red">*</strong></label>
                    <input type="password" name="password" id="password-login-admin" placeholder="Nhập mật khẩu" />
                    <span class="change-pasword-login"><i class="fas fa-eye"></i></span>
                </div>
                <div class="row-item">
                    <button type="button" id="login-admin">Đăng nhập</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
