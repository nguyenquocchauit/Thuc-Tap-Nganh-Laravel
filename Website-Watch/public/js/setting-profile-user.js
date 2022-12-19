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
    $("#save-profile-button").on("click", function () {
        var _action = "Save profile";
        var _id = $("#id-Profile").val();
        var _name = $("#name-Profile").val();
        var _email = $("#email-Profile").val();
        var _phone = $("#phone-Profile").val();
        var _address = $("#address-Profile").val();
        var _pass = $("#pass-Profile").val();
        var _checkPass = $("#checkPass-Profile").val();
        if (_checkPass.length > 0 && _checkPass != null) {
            if (_checkPass == _phone) {
                showMsgWaringRegister(
                    "Mật khẩu không được là số điện thoại đăng ký"
                );
            } else if (_checkPass == _email) {
                showMsgWaringRegister("Mật khẩu không được là Email đăng ký");
            }
        }
        if (isEmpty(_name)) {
            showMsgWaringRegister("Tên không được để trống!");
        } else if (isEmpty(_email)) {
            showMsgWaringRegister("Email không được để trống!");
        } else if (isEmpty(_phone)) {
            showMsgWaringRegister("Số điện thoại không được để trống!");
        } else if (_phone.length <= 9 || _phone.length >= 11) {
            showMsgWaringRegister("Số điện thoại không chính xác!");
        } else if (isEmpty(_pass)) {
            showMsgWaringRegister("Mật khẩu không được để trống!");
        } else if (_pass.length < 6) {
            showMsgWaringRegister("Mật khẩu tối thiểu 6 ký tự!");
        } else {
            $.ajax({
                type: "POST",
                url: "/api/setting-profile",
                data: {
                    token: _token,
                    action: _action,
                    id: _id,
                    name: _name,
                    phone_number: _phone,
                    email: _email,
                    address: _address,
                    password: _pass,
                    changePass: _checkPass,
                },
                success: function (response) {
                    console.log(response);
                    if (
                        response.data.email ==
                            "The email has already been taken." &&
                        response.status == 500
                    ) {
                        showMsgWaringRegister(
                            "Email bạn vừa điền đã tồn tại với tài khoản khác!"
                        );
                    } else if (
                        response.data.phone_number ==
                            "The phone number has already been taken." &&
                        response.status == 500
                    ) {
                        showMsgWaringRegister(
                            "Số điện thoại bạn vừa điền đã tồn tại với tài khoản khác!"
                        );
                    }

                },
            });
        }
    });
});
