$(document).ready(function () {
    function isEmpty(str) {
        return !str || str.length === 0;
    }
    function showMsgWaringLogin(msg, vali) {
        Swal.fire({
            icon: "warning",
            title: msg,
            timer: 1500,
            timerProgressBar: true,
        });
        $(vali).addClass("is-invalid");
    }
    // login customer
    const loginButton = document.getElementById("btn-login-user");

    loginButton.addEventListener("click", function () {
        handleLogin();
    });

    $("#usernameLogin").on("keydown", function (event) {
        if (event.key === "Enter") {
            handleLogin();
        }
    });

    $("#passwordLogin").on("keydown", function (event) {
        if (event.key === "Enter") {
            handleLogin();
        }
    });

    function handleLogin() {
        var _email = $("#usernameLogin").val();
        var _pass = $("#passwordLogin").val();
        if (isEmpty(_email)) {
            showMsgWaringLogin("Email không được để trống!", "#usernameLogin");
        } else if (isEmpty(_pass)) {
            showMsgWaringLogin(
                "Mật khẩu không được để trống!",
                "#passwordLogin"
            );
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
                        response.status == 422 &&
                        response.msg == "Pass is incorrect"
                    )
                        showMsgWaringLogin("Mật khẩu không chính xác!");
                    else if (
                        response.status == 422 &&
                        response.msg == "Email not found"
                    )
                        showMsgWaringLogin("Email không tồn tại!");
                    else if (
                        response.status == 200 &&
                        response.msg == "Login successfully"
                    ) {
                        Swal.fire({
                            icon: "success",
                            title: "Đăng nhập thành công!",
                            html: "Đang đăng nhập vào Website <strong></strong> giây.",
                            imageUrl: "/images/cat.gif",
                            imageWidth: 315,
                            imageHeight: 230,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                // set the time in seconds, initially in milliseconds
                                timerInterval = setInterval(() => {
                                    Swal.getHtmlContainer().querySelector(
                                        "strong"
                                    ).textContent = (
                                        Swal.getTimerLeft() / 1000
                                    ).toFixed(0);
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            },
                        }).then((result) => {
                            // done then reload page
                            if (result.dismiss === Swal.DismissReason.timer) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function (response) {},
            });
        }
    }
});
