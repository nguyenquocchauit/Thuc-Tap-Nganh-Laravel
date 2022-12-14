$(document).ready(function () {
    $("#remove-all-cart").on("click", function () {
        Swal.fire({
            title: "Bạn có chắc muốn xóa toàn bộ giỏ hàng?",
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
                    type: "POST",
                    url: "api/remove-all-cart",
                    data: {
                        action: "Remove all cart",
                    },
                    success: function (response) {
                        console.log(response);
                        if (
                            response.status == 200 &&
                            response.msg == "Remove successfully"
                        ) {
                            location.reload();
                        }
                    },
                });
            }
        });
    });
});
