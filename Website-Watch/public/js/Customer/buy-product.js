$(document).ready(function () {
    $("#payment").on("click", function () {
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
        } else if (
            typeof $("input[name='payment_method']:checked").val() ===
            "undefined"
        )
            Swal.fire({
                icon: "warning",
                title: "Vui lòng chọn phương thức thanh toán",
            });
        else {
            // Lấy giá trị của các input select và ô nhập địa chỉ
            var city = $("#cityy option:selected").html();
            var district = $("#districtt option:selected").html();
            var ward = $("#wardd option:selected").html();
            var address = $("#address").val();
            var notes = $("#order_notes").val();
            if (notes == null) {
                notes = "Không có";
            }
            // Tạo chuỗi đại diện cho địa chỉ của khách hàng mới
            var address_value =
                address + ", " + ward + ", " + district + ", " + city;
            $.ajax({
                type: "POST",
                url:
                    "/api/checkout/" +
                    $("input[name='payment_method']:checked").val(),
                data: {
                    action: "Order",
                    user: $("#ID-User").val(),
                    address: address_value,
                    order_notes: notes,
                },
                success: function (response) {
                    if (response.msg == "bank")
                        window.open(response.url, "_blank");
                    else if (response.msg == "cash payment") {
                        Swal.fire({
                            icon: "success",
                            title: "Đặt hàng thành công!",
                            timer: 3000,
                            timerProgressBar: true,
                        }).then((result) => {
                            window.location.href = "/lich-su-dat-hang";
                        });
                    }
                },
            });
        }
    });
    $("#cancel-order").on("click", function () {
        Swal.fire({
            title:
                "Bạn chắc chắn muốn hủy đơn hàng này?",
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
                    url: "/api/cancel-order/" + $("#id-detail-order").val(),
                    success: function (response) {
                        console.log(response);
                        if (
                            response.status == 200 &&
                            response.msg == "Cancel order successfully"
                        ) {
                            Swal.fire({
                                icon: "success",
                                title: "Hủy thành công!",
                                timer: 2000,
                                timerProgressBar: true,
                            }).then((result) => {
                                window.location.href = "/lich-su-dat-hang";
                            });
                        }
                    },
                });
            }
        });
    });
});
