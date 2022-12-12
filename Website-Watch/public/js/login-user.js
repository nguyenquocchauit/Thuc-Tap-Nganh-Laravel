$(document).ready(function () {
    //Pass Header Token
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    let _token = $('meta[name="csrf-token"]').attr("content");
    function isEmpty(str) {
        return !str || str.length === 0;
    }
    $("#btn-login-user").on("click", function () {
        var _email = $("#usernameLogin").val();
        var _pass = $("#passwordLogin").val();
        if (isEmpty(_email)) {
            Swal.fire({
                icon: "warning",
                title: "Email không được để trống!",
                timer: 1500,
                timerProgressBar: true,
            });
        } else if (isEmpty(_pass)) {
            Swal.fire({
                icon: "warning",
                title: "Mật khẩu không được để trống!",
                timer: 1500,
                timerProgressBar: true,
            });
        } else {
            $.ajax({
                type: "POST",
                url: "/api/login-user",
                data: {
                    token: _token,
                    email: _email,
                    password: _pass,
                },
                success: function (response) {
                    if (
                        response.status == 401 &&
                        response.msg == "Pass is incorrect"
                    ) {
                        Swal.fire({
                            icon: "warning",
                            title: "Mật khẩu không chính xác!",
                            timer: 1500,
                            timerProgressBar: true,
                        });
                    } else if (
                        response.status == 401 &&
                        response.msg == "Email not found"
                    ) {
                        Swal.fire({
                            icon: "warning",
                            title: "Email không tồn tại!",
                            timer: 1500,
                            timerProgressBar: true,
                        });
                    } else if (
                        response.status == 1 &&
                        response.msg == "Login success"
                    ) {
                        Swal.fire({
                            icon: "success",
                            title: "Login success!",
                            timer: 1500,
                            timerProgressBar: true,
                        });
                    }
                },
                error: function (response) {},
            });
        }
    });
});
