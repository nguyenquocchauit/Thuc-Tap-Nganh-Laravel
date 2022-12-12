$(document).ready(function () {
    function isEmpty(str) {
        return !str || str.length === 0;
    }
    function showMsgWaringRegister(msg) {
        Swal.fire({
            icon: "warning",
            title: msg,
            timer: 1500,
            timerProgressBar: true,
        });
    }
    $("#btn-register-user").on("click", function () {
        var _name = $("#nameRegister").val();
        var _email = $("#emailRegister").val();
        var _phone = $("#phoneRegister").val();
        var _address = $("#addressRegister").val();
        var _pass = $("#passRegister").val();
        var _checkPass = $("#checkPassRegister").val();
        if (isEmpty(_name)) {
            showMsgWaring("Tên không được để trống!");
        } else if (isEmpty(_email)) {
            showMsgWaring("Email không được để trống!");
        } else if (isEmpty(_phone)) {
            showMsgWaring("Số điện thoại không được để trống!");
        } else if (isEmpty(_pass)) {
            showMsgWaring("Mật khẩu không được để trống!");
        } else if (_pass.length < 6) {
            showMsgWaring("Mật khẩu tối thiểu 6 ký tự!");
        } else if (isEmpty(_checkPass)) {
            showMsgWaring("Vui lòng xác minh lại mật khẩu!");
        } else if (_pass != _checkPass) {
            showMsgWaring(
                "Xác nhận mật khẩu không chính xác, vui lòng kiểm tra lại!"
            );
        } else {
            $.ajax({
                type: "POST",
                url: "/api/register-user",
                data: {
                    token: _token,
                    name: _name,
                    email: _email,
                    phone: _phone,
                    address: _address,
                    password: _pass,
                },
                success: function (response) {
                    console.log(response);
                    if (response.status == 400)
                        showMsgWaringRegister("Email đã tồn tại!");
                    else if (
                        response.status == 200 &&
                        response.msg == "Registered successfully"
                    )
                    Swal.fire({
                        icon: "success",
                        title: "Đăng ký thành công!",
                        timer: 1500,
                        timerProgressBar: true,
                    });
                },
                error: function (response) {},
            });
        }
    });
});
