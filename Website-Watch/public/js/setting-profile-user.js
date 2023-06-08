$(document).ready(function () {
    setInterval(function () {
        $("#avatar-customer").animate({ left: "+=10px" }, 200);
        $("#avatar-customer").animate({ left: "-=10px" }, 200);
        $("#avatar-customer").animate({ top: "-=10px" }, 200);
        $("#avatar-customer").animate({ top: "+=10px" }, 200);
    }, 1000);
    function isEmpty(str) {
        return !str || str.length === 0;
    }
    function showMsgWaring(msg, vali) {
        Swal.fire({
            icon: "warning",
            title: msg,
            timer: 1500,
            timerProgressBar: true,
        });
        $(vali).addClass("is-invalid");
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
                showMsgWaring(
                    "Mật khẩu không được là số điện thoại đăng ký"
                );
            } else if (_checkPass == _email) {
                showMsgWaring("Mật khẩu không được là Email đăng ký");
            } else if (_pass == _checkPass) {
                showMsgWaring(
                    "Mật khẩu mới không được giống mật khẩu hiện tại"
                );
            }
        }
        if (isEmpty(_name)) {
            showMsgWaring("Tên không được để trống!", "#name-Profile");
        } else if (isEmpty(_email)) {
            showMsgWaring(
                "Email không được để trống!",
                "#email-Profile"
            );
        } else if (isEmpty(_phone)) {
            showMsgWaring(
                "Số điện thoại không được để trống!",
                "#phone-Profile"
            );
        } else if (_phone.length <= 9 || _phone.length >= 11) {
            showMsgWaring(
                "Số điện thoại không chính xác!",
                "#phone-Profile"
            );
        } else if (isEmpty(_pass)) {
            showMsgWaring(
                "Mật khẩu không được để trống!",
                "#pass-Profile"
            );
        } else if (_pass.length < 6) {
            showMsgWaring(
                "Mật khẩu tối thiểu 6 ký tự!",
                "#pass-Profile"
            );
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
                        response.email == "The email has already been taken." &&
                        response.status == 500
                    ) {
                        showMsgWaring(
                            "Email bạn vừa điền đã tồn tại với tài khoản khác!",
                            "#email-Profile"
                        );
                    } else if (
                        response.phone ==
                            "The phone number has already been taken." &&
                        response.status == 500
                    ) {
                        showMsgWaring(
                            "Số điện thoại bạn vừa điền đã tồn tại với tài khoản khác!",
                            "#phone-Profile"
                        );
                    } else if (
                        response.msg == "Cofirm password incorrect" &&
                        response.status == 500
                    ) {
                        showMsgWaring(
                            "Xác nhận mật khẩu không chính xác!",
                            "#pass-Profile"
                        );
                    } else if (
                        response.msg == "Update information successfully" &&
                        response.status == 200
                    ) {
                        Swal.fire({
                            icon: "success",
                            title: "Cập nhật thành công!",
                            timer: 1500,
                            timerProgressBar: true,
                        }).then((result) => {
                            // done then reload page
                            if (result.dismiss === Swal.DismissReason.timer) {
                                location.reload();
                            }
                        });
                    }
                },
            });
        }
    });
});
