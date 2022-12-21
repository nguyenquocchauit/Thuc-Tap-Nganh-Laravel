$(document).ready(function () {
    $("#buy-product").on("click", function () {
        // id user có tồn tại (tức đã login) thì thực hiện được action comment product
        if (typeof $("#ID-User").val() === "undefined") {
            Swal.fire({
                icon: "warning",
                title: "Đăng nhập để đặt sản phẩm",
                timer: 2500,
                timerProgressBar: true,
                confirmButtonText: "Đăng nhập",
            }).then((result) => {
                // click vào đăng nhập thì show modal đăng nhập
                if (result.isConfirmed) {
                    $("#login").modal("show");
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "/api/buy-product-from-cart",
                data: {
                    action: "Buy product from cart",
                    token: _token,
                    user: $("#ID-User").val(),
                },
                success: function (response) {
                    console.log(response);
                    if (
                        response.status == 500 &&
                        response.msg == "User has not updated the address"
                    ) {
                        Swal.fire({
                            icon: "warning",
                            title: "Cập nhật địa chỉ để tiếp tục đặt hàng!",
                            timer: 2500,
                            timerProgressBar: true,
                            confirmButtonText: "Cài đặt thông tin",
                        }).then((result) => {
                            // click vào đăng nhập thì show modal đăng nhập
                            if (result.isConfirmed) {
                                window.location.href = "/thong-tin-ca-nhan";
                            }
                        });
                    } else if (
                        response.status == 200 &&
                        response.msg == "Order successfully"
                    ) {
                        Swal.fire({
                            icon: "success",
                            title: "Đặt hàng thành công!",
                            timer: 3000,
                            timerProgressBar: true,
                        }).then((result) => {
                            location.reload();
                        });

                    }
                },
            });
        }
    });
});
