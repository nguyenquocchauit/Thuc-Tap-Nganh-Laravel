$(document).ready(function () {
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
    //create employee
    $("#btn-create-employee").on("click", function () {
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
            var formData = new FormData($("#create-employee")[0]);
            formData.set("address", content);

            // Gửi dữ liệu của khách hàng mới lên server bằng phương thức POST
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                url: "/api/admin/employee/create",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    if (
                        response.status == 200 &&
                        response.msg == "Create employee successfully"
                    ) {
                        Swal.fire({
                            icon: "success",
                            title: "Thêm nhân viên thành công!",
                            timer: 2000,
                            timerProgressBar: true,
                        }).then((result) => {
                            window.location.href = "/admin/employee";
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
    // delete employee
    $(".btn-delete-employee").on("click", function () {
        let id = $(this).find("input").val();
        Swal.fire({
            title: "Bạn có chắc muốn xóa nhân viên này?",
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
                    url: "/api/admin/employee/delete/" + id,
                    success: function (response) {
                        if (
                            response.status == 200 &&
                            response.msg == "Delete employee successfully"
                        ) {
                            window.location.href = "/admin/employee";
                        }
                    },
                });
            }
        });
    });

    // review image product
    $(document).on("change", "#image-profile", function () {
        let reader = new FileReader();

        // Kiểm tra định dạng file ảnh
        let file = this.files[0];
        let fileType = file["type"];
        let validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            // Hiển thị thông báo lỗi nếu định dạng file không hợp lệ
            showMsgWaring(
                "Chỉ cho phép định dạng ảnh jpg,png,jpeg",
                ".image-profile"
            );
            $(this).val("");
            return false;
        }

        reader.onload = (e) => {
            $("#avt-review").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
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
            errors.role &&
            errors.role.length > 0 &&
            errors.role[0] == "Empty role"
        ) {
            showMsgWaring("Vui lòng chọn chức vụ!", "#position");
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
        } else if (
            errors.image_profile &&
            errors.image_profile.length > 0 &&
            errors.image_profile[0] == "Incorrect image format"
        ) {
            showMsgWaring("Không đúng định dạng ảnh!", "#image-profile");
        } else if (
            errors.image_profile &&
            errors.image_profile.length > 0 &&
            errors.image_profile[0] == "Empty image"
        ) {
            showMsgWaring("Vui lòng chọn ảnh đại diện!", "#image-profile");
        } else if (
            errors.image_profile &&
            errors.image_profile.length > 0 &&
            errors.image_profile[0] == "jpg, png, jpeg."
        ) {
            showMsgWaring(
                "Chỉ cho phép định dạng ảnh jpg,png,jpeg!",
                "#image-profile"
            );
        }
    }
});
