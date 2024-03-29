$(document).ready(function () {
    // check format name
    $("#name").on("keypress paste", function () {
        var name = $(this).val();
        var pattern = /^[a-zA-ZÀ-ỹ ]*$/;
        $(this)
            .toggleClass("is-valid", pattern.test(name))
            .toggleClass("is-invalid", !pattern.test(name));
    });
    // review name
    $("#name").keyup(function () {
        var value = $(this).val();
        $("#review-name").text(value);
    });
    // review position
    $("#position").on("change", function () {
        var value = $(this).val();
        if (value == "1") $("#review-position").text("Nhân viên");
        else if (value == "2") $("#review-position").text("Quản trị viên");
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
    //create customer
    $("#btn-create-customer").on("click", function () {
        // Lấy giá trị của các input select và ô nhập địa chỉ
        var city = $("#city option:selected").html();
        var district = $("#district option:selected").html();
        var ward = $("#ward option:selected").html();
        var address = $("#address").val();

        // Kiểm tra xem các giá trị của các input select và ô nhập địa chỉ có rỗng hay không
        if (
            !city ||
            !district ||
            !ward ||
            !address ||
            $("#city option:selected").val() == "" ||
            $("#district option:selected").val() == "" ||
            $("#ward option:selected").val() == ""
        ) {
            // Hiển thị thông báo lỗi nếu có giá trị rỗng
            showMsgWaring("Địa chỉ không được để trống!", "#address");
        } else {
            // Tạo chuỗi đại diện cho địa chỉ của khách hàng mới
            content = address + ", " + ward + ", " + district + ", " + city;

            // Tạo đối tượng FormData để gửi dữ liệu của khách hàng mới lên server
            var formData = new FormData($("#create-customer")[0]);
            formData.set("address", content);

            // Gửi dữ liệu của khách hàng mới lên server bằng phương thức POST
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
                            window.location.href = "/admin/customer";
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

    //update customer
    $("#btn-update-customer").on("click", function () {
        // Lấy giá trị của các input select và ô nhập địa chỉ
        var city = $("#city option:selected").html();
        var district = $("#district option:selected").html();
        var ward = $("#ward option:selected").html();
        var address = $("#address").val();

        // Kiểm tra xem các giá trị của các input select và ô nhập địa chỉ có rỗng hay không
        if (!city || !district || !ward || !address) {
            // Hiển thị thông báo lỗi nếu có giá trị rỗng
            showMsgWaring("Địa chỉ không được để trống!", "#address");
        } else {
            // Tạo chuỗi đại diện cho địa chỉ của khách hàng mới
            content = address + ", " + ward + ", " + district + ", " + city;

            // Tạo đối tượng FormData để gửi dữ liệu của khách hàng mới lên server
            var formData = new FormData($("#update-customer")[0]);
            formData.set("address", content);

            // Gửi dữ liệu của khách hàng mới lên server bằng phương thức POST
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
    // delete customer
    $(".btn-delete-customer").on("click", function () {
        let id = $(this).find("input").val();
        Swal.fire({
            title: "Bạn có chắc muốn xóa khách hàng?",
            text: "Xóa rồi không thể hoàn tác!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý",
            cancelButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "/api/admin/customer/delete/" + id,
                    success: function (response) {
                        if (
                            response.status == 200 &&
                            response.msg == "Delete customer successfully"
                        ) {
                            window.location.href = "/admin/customer";
                        }
                    },
                });
            }
        });
    });
    $(".change-pasword").on("click", function () {
        var passwordField = $(this).prev();
        var passwordFieldType = passwordField.attr("type");
        if (passwordFieldType === "password") {
            passwordField.attr("type", "text");
            $(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            passwordField.attr("type", "password");
            $(this).find("i").removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
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
            errors.address &&
            errors.address.length > 0 &&
            errors.address[0] == "Empty address"
        ) {
            showMsgWaring("Địa chỉ không được để trống!", "#address");
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
            errors.password_confirmation[0] == "Doesn't match"
        ) {
            showMsgWaring("Mật khẩu xác nhận sai!", "#password_confirmation");
        }
    }
});
