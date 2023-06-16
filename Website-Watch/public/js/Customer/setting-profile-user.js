$(document).ready(function () {
    setInterval(function () {
        $("#avatar-customer").animate({ left: "+=10px" }, 200);
        $("#avatar-customer").animate({ left: "-=10px" }, 200);
        $("#avatar-customer").animate({ top: "-=10px" }, 200);
        $("#avatar-customer").animate({ top: "+=10px" }, 200);
    }, 1000);

    $("#btn-update-customer").on("click", function () {
        // content will contain the content of the selected <option> element
        var city = $("#cityy option:selected").html();
        var district = $("#districtt option:selected").html();
        var ward = $("#wardd option:selected").html();
        var address = $("#addresss").val();
        if (!city || !district || !ward || !address) {
            // At least one of the variables is null or has no value
            showMsgWaring("Địa chỉ không được để trống!", "#address");
        } else {
            // connecting the chain of province + city + district/commune
            content = address + ", " + ward + ", " + district + ", " + city;
            // form initialization
            var formData = new FormData($("#update-profile-customer")[0]);
            formData.set("address", content);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                url: "/api/profile-customer/update/" + $("#ID-User").val(),
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    if (
                        response.status == 200 &&
                        response.msg == "Update profile customer successfully"
                    ) {
                        Swal.fire({
                            icon: "success",
                            title: "Cập nhật thành công!",
                            timer: 2000,
                            timerProgressBar: true,
                        }).then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function (response) {
                    var errors = response.responseJSON.errors;
                    showErrors(errors);
                },
            });
        }
    });
    // update password profile customer
    $("#bth-update-pass-profile-customer").on("click", function () {

        var oldPass = $("#old-password").val();
        var newPass = $("#new-password").val();
        var confirmPass = $("#confirm-password").val();
        if (oldPass && newPass && confirmPass) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                url:
                    "/api/profile-customer/update-password/" +
                    $("#ID-User").val(),
                data: {
                    oldPass: oldPass,
                    newPass: newPass,
                    confirmPass: confirmPass,
                },
                success: function (response) {
                    if (
                        response.status == 200 &&
                        response.msg == 'Update password successfully'
                    ) {
                        Swal.fire({
                            icon: "success",
                            title: "Cập nhật mật khẩu thành công!",
                            timer: 2000,
                            timerProgressBar: true,
                        }).then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function (response) {
                    var errors = response.responseJSON.errors;
                    if (
                        errors.oldPass &&
                        errors.oldPass.length > 0 &&
                        errors.oldPass[0] == "Empty password"
                    ) {
                        showMsgWaring(
                            "Mật khẩu hiện tại không được để trống!",
                            "#old-password"
                        );
                    } else if (
                        errors.oldPass &&
                        errors.oldPass.length > 0 &&
                        errors.oldPass[0] == "Doesn't match"
                    ) {
                        showMsgWaring(
                            "Mật khẩu hiện tại không chính xác!",
                            "#old-password"
                        );
                    } else if (
                        errors.newPass &&
                        errors.newPass.length > 0 &&
                        errors.newPass[0] == "Empty new password"
                    ) {
                        showMsgWaring(
                            "Mật khẩu mới không được để trống!",
                            "#new-password"
                        );
                    } else if (
                        errors.newPass &&
                        errors.newPass.length > 0 &&
                        errors.newPass[0] == "Min"
                    ) {
                        showMsgWaring(
                            "Mật khẩu mới tối thiểu 6 ký tự!",
                            "#new-password"
                        );
                    } else if (
                        errors.newPass &&
                        errors.newPass.length > 0 &&
                        errors.newPass[0] == "Max"
                    ) {
                        showMsgWaring(
                            "Mật khẩu mới tối đa 30 ký tự!",
                            "#new-password"
                        );
                    } else if (
                        errors.confirmPass &&
                        errors.confirmPass.length > 0 &&
                        errors.confirmPass[0] == "Empty confirm password"
                    ) {
                        showMsgWaring(
                            "Xác nhận mật khẩu mới không được để trống!",
                            "#confirm-password"
                        );
                    } else if (
                        errors.confirmPass &&
                        errors.confirmPass.length > 0 &&
                        errors.confirmPass[0] == "Doesn't match"
                    ) {
                        showMsgWaring(
                            "Xác nhận mật khẩu không chính xác!",
                            "#confirm-password"
                        );
                    }
                },
            });
        }
    });
    // message error
    function showMsgWaring(msg, vali) {
        Swal.fire({
            icon: "warning",
            title: msg,
            timer: 2000,
            timerProgressBar: true,
        });
        $(vali).addClass("is-invalid");
    }
    function showErrors(errors) {
        if (
            errors.name &&
            errors.name.length > 0 &&
            errors.name[0] == "Empty name"
        ) {
            showMsgWaring("Tên không được để trống!", "#name");
        } else if (
            errors.name &&
            errors.name.length > 0 &&
            errors.name[0] == "Incorrect name format"
        ) {
            showMsgWaring("Tên không hợp lệ!", "#name");
        } else if (
            errors.phone_number &&
            errors.phone_number.length > 0 &&
            errors.phone_number[0] == "Empty phone"
        ) {
            showMsgWaring(
                "Số điện thoại không được để trống!",
                "#phone_number"
            );
        } else if (
            errors.phone_number &&
            errors.phone_number.length > 0 &&
            errors.phone_number[0] == "Incorrect phone format"
        ) {
            showMsgWaring("Số điện thoại không hợp lệ!", "#phone_number");
        } else if (
            errors.email &&
            errors.email.length > 0 &&
            errors.email[0] == "Empty email"
        ) {
            showMsgWaring("Email không được để trống!", "#email");
        } else if (
            errors.email &&
            errors.email.length > 0 &&
            errors.email[0] == "Email already exists"
        ) {
            showMsgWaring("Email đã tồn tại!", "#email");
        } else if (
            errors.email &&
            errors.email.length > 0 &&
            errors.email[0] == "Incorrect email format"
        ) {
            showMsgWaring("Email không hợp lệ!", "#email");
        } else if (
            errors.address &&
            errors.address.length > 0 &&
            errors.address[0] == "Empty address"
        ) {
            showMsgWaring("Địa chỉ không được để trống!", "#address");
        } else if (
            errors.password &&
            errors.password.length > 0 &&
            errors.password[0] == "Empty password"
        ) {
            showMsgWaring("Mật khẩu không được để trống!", "#password");
        } else if (
            errors.password &&
            errors.password.length > 0 &&
            errors.password[0] == "Min"
        ) {
            showMsgWaring("Mật khẩu tối thiểu 6 ký tự!", "#password");
        } else if (
            errors.password &&
            errors.password.length > 0 &&
            errors.password[0] == "Max"
        ) {
            showMsgWaring("Mật khẩu tối đa 30 ký tự!", "#password");
        } else if (
            errors.password_confirmation &&
            errors.password_confirmation.length > 0 &&
            errors.password_confirmation[0] == "Empty password confirmation"
        ) {
            showMsgWaring(
                "Xác nhận mật khẩu không được để trống!",
                "#password_confirmation"
            );
        } else if (
            errors.password_confirmation &&
            errors.password_confirmation.length > 0 &&
            errors.password_confirmation[0] == "Min"
        ) {
            showMsgWaring(
                "Xác nhận mật khẩu tối thiểu 6 ký tự!",
                "#password_confirmation"
            );
        } else if (
            errors.password_confirmation &&
            errors.password_confirmation.length > 0 &&
            errors.password_confirmation[0] == "Max"
        ) {
            showMsgWaring(
                "Xác nhận mật khẩu tối đa 30 ký tự!",
                "#password_confirmation"
            );
        } else if (
            errors.password_confirmation &&
            errors.password_confirmation.length > 0 &&
            errors.password_confirmation[0] == "Doesn't match"
        ) {
            showMsgWaring("Mật khẩu xác nhận sai!", "#password_confirmation");
        }
    }
});
