$(document).ready(function () {
    function isEmpty(str) {
        return !str || str.length === 0;
    }
    function showMsgWaringLogin(msg) {
        Swal.fire({
            icon: "warning",
            title: msg,
            timer: 1500,
            timerProgressBar: true,
        });
    }
    $("#btn-login-user").on("click", function () {
        var _email = $("#usernameLogin").val();
        var _pass = $("#passwordLogin").val();
        if (isEmpty(_email)) showMsgWaringLogin("Email không được để trống!");
        else if (isEmpty(_pass))
            showMsgWaringLogin("Mật khẩu không được để trống!");
        else {
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
                    )
                        showMsgWaringLogin("Mật khẩu không chính xác!");
                    else if (
                        response.status == 401 &&
                        response.msg == "Email not found"
                    )
                        showMsgWaringLogin("Email không tồn tại!");
                    else if (
                        response.status == 200 &&
                        response.msg == "Login successfully"
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
