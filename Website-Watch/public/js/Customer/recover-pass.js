$(document).ready(function () {
    $("#btn-recover-password").on("click", function () {
        $.ajax({
            type: "POST",
            url: "/api/recover-password/",
            data: { email: $("#email_recover").val() },
            success: function (response) {
                if (response.status == 200 && response.msg == "Check mail") {
                    Swal.fire({
                        icon: "success",
                        title: "Vui lòng kiểm tra Email!",
                        timer: 2000,
                        timerProgressBar: true,
                    });
                } else if (
                    response.status == 422 &&
                    response.msg == "Email is not registered"
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "Email chưa đăng ký!",
                        timerProgressBar: true,
                    });
                }
            },
            error: function (response) {},
        });
    });
    $("#update-password-customer").on("click", function () {
        if (!$("#password").val() || !$("#confirm-password").val())
            Swal.fire({
                icon: "warning",
                title: "Vui lòng kiểm tra thông tin!",
                timerProgressBar: true,
            });
        else if (
            $("#password").val().length < 6 ||
            $("#password").val().length > 30
        )
            Swal.fire({
                icon: "warning",
                title: "Mật khẩu lớn hơn 6 ký tự và nhỏ hơn 30!",
                timerProgressBar: true,
            });
        else if ($("#password").val() != $("#confirm-password").val())
            Swal.fire({
                icon: "warning",
                title: "Mật khẩu xác nhận không đúng!",
                timerProgressBar: true,
            });
        else {
            $.ajax({
                type: "POST",
                url: "/api/update-new-password",
                data: {
                    email: $("#email").val(),
                    token: $("#token").val(),
                    password: $("#password").val(),
                },
                success: function (response) {
                    if (
                        response.status == 200 &&
                        response.msg == "Reset password successfully"
                    ) {
                        Swal.fire({
                            icon: "success",
                            title: "Đổi mật khẩu thành công!",
                            timer: 3000,
                            timerProgressBar: true,
                        }).then((result) => {
                            window.location.href = "/";
                        });
                    } else if (
                        response.status == 422 &&
                        response.msg == "Error"
                    ) {
                        Swal.fire({
                            icon: "warning",
                            title: "Đã có lỗi xảy ra!",
                            timerProgressBar: true,
                        });
                    }
                },
                error: function (response) {},
            });
        }
    });
});
