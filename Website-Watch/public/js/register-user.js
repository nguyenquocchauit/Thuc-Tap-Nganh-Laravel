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
        console.log(_phone);
        if (isEmpty(_name)) {
            showMsgWaringRegister("Tên không được để trống!");
        } else if (isEmpty(_email)) {
            showMsgWaringRegister("Email không được để trống!");
        } else if (isEmpty(_phone)) {
            showMsgWaringRegister("Số điện thoại không được để trống!");
        } else if (isEmpty(_pass)) {
            showMsgWaringRegister("Mật khẩu không được để trống!");
        } else if (_pass.length < 6) {
            showMsgWaringRegister("Mật khẩu tối thiểu 6 ký tự!");
        } else if (isEmpty(_checkPass)) {
            showMsgWaringRegister("Vui lòng xác minh lại mật khẩu!");
        } else if (_pass != _checkPass) {
            showMsgWaringRegister(
                "Xác nhận mật khẩu không chính xác, vui lòng kiểm tra lại!"
            );
        } else if (_pass == _phone) {
            showMsgWaringRegister(
                "Mật khẩu không được là số điện thoại đăng ký"
            );
        } else if (_pass == _email) {
            showMsgWaringRegister("Mật khẩu không được là Email đăng ký");
        } else {
            $.ajax({
                type: "POST",
                url: "/api/register-user",
                data: {
                    token: _token,
                    name: _name,
                    phone_number: _phone,
                    email: _email,
                    address: _address,
                    password: _pass,
                },
                success: function (response) {
                    console.log(response);
                    if (
                        response.status == 400 &&
                        response.msg.phone_number ==
                            "The phone number has already been taken."
                    )
                        showMsgWaringRegister("Số điện thoại đã tồn tại!");
                    else if (
                        response.status == 400 &&
                        response.msg.email ==
                            "The email has already been taken."
                    )
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
