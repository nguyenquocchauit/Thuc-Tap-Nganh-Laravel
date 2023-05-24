$(document).ready(function () {
    // check format email
    $("#name").on("keypress paste", function () {
        var name = $(this).val();
        var pattern = /^[a-zA-ZÀ-ỹ ]*$/;
        $(this)
            .toggleClass("is-valid", pattern.test(name))
            .toggleClass("is-invalid", !pattern.test(name));
    });

    // check format email
    $("#email").on("keypress paste", function () {
        var email = $(this).val();
        var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        $(this)
            .toggleClass("is-valid", pattern.test(email))
            .toggleClass("is-invalid", !pattern.test(email));
    });
    // check format phone
    $("#phone_number").on("keypress paste", function () {
        var phone = $(this).val();
        var pattern = /(09|03|07|08|05)+([0-9]{7})\b/;
        $(this)
            .toggleClass("is-valid", pattern.test(phone))
            .toggleClass("is-invalid", !pattern.test(phone));
    });
    // check password and confirm password
    $("#password, #password_confirmation").on("keypress paste", function () {
        var name = $(this).val();
        var pattern = /^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]{5,19}$/;
        $(this)
            .toggleClass("is-valid", pattern.test(name))
            .toggleClass("is-invalid", !pattern.test(name));
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
    function isEmpty(str) {
        return !str || str.length === 0;
    }
    //create customer
    $("#btn-create-customer").on("click", function () {
        let address = $("#address").val();
        let password = $("#password").val();
        let confirmPassword = $("#password_confirmation").val();
        var formData = new FormData($("#create-customer")[0]);
        if (mandatoryTest("#create-customer")) {
            if (isEmpty(address))
                showMsgWaring("Vui lòng nhập địa chỉ!!!", "#address");
            else if (isEmpty(password))
                showMsgWaring("Vui lòng nhập mật khẩu!!!", "#password");
            else if (isEmpty(confirmPassword))
                showMsgWaring(
                    "Vui lòng nhập xác nhận mật khẩu",
                    "#password_confirmation"
                );
            else {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "POST",
                    url: "/api/admin/customer/create",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        if (
                            response.status == 200 &&
                            response.msg == "Create customer successfully"
                        ) {
                            Swal.fire({
                                icon: "success",
                                title: "Thêm khách hàng thành công!",
                                timer: 2000,
                                timerProgressBar: true,
                            }).then((result) => {
                                window.location.href =
                                    "/admin/product/" + response.id + "/edit";
                            });
                        } else if (
                            response.status == 422 &&
                            response.msg == "Password incorrect"
                        ) {
                            showMsgWaring(
                                "Mật khẩu xác nhận không chính xác!!!",
                                "#password_confirmation"
                            );
                        } else if (
                            response.status == 422 &&
                            response.msg == "Incorrect name format"
                        ) {
                            showMsgWaring("Tên không hợp lệ!", "#name");
                        } else if (
                            response.status == 422 &&
                            response.msg == "Incorrect phone format"
                        ) {
                            showMsgWaring(
                                "Số điện thoại không hợp lệ!",
                                "#phone_number"
                            );
                        } else if (
                            response.status == 422 &&
                            response.msg == "Incorrect email format"
                        ) {
                            showMsgWaring("Email không hợp lệ!", "#email");
                        }
                    },
                });
            }
        }
    });
    //update customer
    $("#btn-update-customer").on("click", function () {
        if (mandatoryTest("#update-customer")) {
            // content will contain the content of the selected <option> element
            var city = $("#city option:selected").html();
            var district = $("#district option:selected").html();
            var ward = $("#ward option:selected").html();
            var address = $("#address").val();
            // connecting the chain of province + city + district/commune
            content = address + ", " + ward + ", " + district + ", " + city;
            // form initialization
            var formData = new FormData($("#update-customer")[0]);
            // change the key address to the new value content
            formData.set("address", content);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                url: "/api/admin/customer/update/" + $("#id-customer").val(),
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    if (
                        response.status == 200 &&
                        response.msg == "Update customer successfully"
                    ) {
                        Swal.fire({
                            icon: "success",
                            title: "Cập nhật thành công!",
                            timer: 2000,
                            timerProgressBar: true,
                        }).then((result) => {
                            window.location.href =
                                "/admin/customer/" +
                                $("#id-customer").val() +
                                "/edit";
                        });
                    } else if (
                        response.status == 422 &&
                        response.msg == "Incorrect name format"
                    ) {
                        showMsgWaring("Tên không hợp lệ!", "#name");
                    } else if (
                        response.status == 422 &&
                        response.msg == "Incorrect phone format"
                    ) {
                        showMsgWaring(
                            "Số điện thoại không hợp lệ!",
                            "#phone_number"
                        );
                    } else if (
                        response.status == 422 &&
                        response.msg == "Incorrect email format"
                    ) {
                        showMsgWaring("Email không hợp lệ!", "#email");
                    }
                },
            });
        }
    });
    function mandatoryTest(form) {
        var formData = new FormData($(form)[0]);
        var keys = ["name", "phone_number", "email"];
        for (var i = 0; i < keys.length; i++) {
            if (!(formData.has(keys[i]) && formData.get(keys[i]))) {
                if (i == 0) {
                    showMsgWaring("Vui lòng nhập tên khách hàng!!!", "#name");
                    break;
                }
                if (i == 1) {
                    showMsgWaring(
                        "Vui lòng nhập số điện thoại!!!",
                        "#phone_number"
                    );
                    break;
                }
                if (i == 2) {
                    showMsgWaring("Vui lòng nhập Email!!!", "#email");
                    break;
                }
            }
            if (i == 2) return true;
        }
        return false;
    }
});
