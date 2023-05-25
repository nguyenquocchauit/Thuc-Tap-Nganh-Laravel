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
    //create brand
    $("#btn-create-brand").on("click", function () {
        var formData = new FormData($("#create-brand")[0]);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: "/api/admin/brand/create",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if (
                    response.status == 200 &&
                    response.msg == "Create brand successfully"
                ) {
                    Swal.fire({
                        icon: "success",
                        title: "Thêm hãng mới thành công!",
                        timer: 2000,
                        timerProgressBar: true,
                    }).then((result) => {
                        window.location.href = "/admin/brand";
                    });
                }
            },
            error: function (response) {
                var errors = response.responseJSON.errors;
                if (
                    errors.name &&
                    errors.name.length > 0 &&
                    errors.name[0] == "Empty name"
                ) {
                    showMsgWaring("Tên không được để trống!", "#name");
                } else if (
                    errors.name &&
                    errors.name.length > 0 &&
                    errors.name[0] == "Name already exists"
                ) {
                    showMsgWaring("Tên hãng đã tồn tại!", "#name");
                } else if (
                    errors.name &&
                    errors.name.length > 0 &&
                    errors.name[0] == "Incorrect name format"
                ) {
                    showMsgWaring("Tên hãng không đúng định dạng!", "#name");
                }
            },
        });
    });
    //update brand
    $("#btn-update-brand").on("click", function () {
        var formData = new FormData($("#update-brand")[0]);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: "/api/admin/brand/update/" + $("#id-brand").val(),
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if (
                    response.status == 200 &&
                    response.msg == "Update brand successfully"
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
                if (
                    errors.name &&
                    errors.name.length > 0 &&
                    errors.name[0] == "Empty name"
                ) {
                    showMsgWaring("Tên không được để trống!", "#name");
                } else if (
                    errors.name &&
                    errors.name.length > 0 &&
                    errors.name[0] == "Name already exists"
                ) {
                    showMsgWaring("Tên hãng đã tồn tại!", "#name");
                } else if (
                    errors.name &&
                    errors.name.length > 0 &&
                    errors.name[0] == "Incorrect name format"
                ) {
                    showMsgWaring("Tên hãng không đúng định dạng!", "#name");
                }else if (
                    errors.slug &&
                    errors.slug.length > 0 &&
                    errors.slug[0] == "Slug already exists"
                ) {
                    showMsgWaring("Slug đã tồn tại!", "#name");
                }
            },
        });
    });
    // delete brand
    $(".btn-delete-brand").on("click", function () {
        let id = $(this).find("input").val();
        Swal.fire({
            title: "Bạn có chắc muốn xóa hãng này?",
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
                    url: "/api/admin/brand/delete/" + id,
                    success: function (response) {
                        if (
                            response.status == 200 &&
                            response.msg == "Delete brand successfully"
                        ) {
                            window.location.href = "/admin/brand";
                        }
                    },
                });
            }
        });
    });
});
