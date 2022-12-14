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
    // thêm nút tăng giảm vào trước và sau input số lượng
    $(".numbers-row")
        .find(".desc")
        .append('<button class="btnquantity buttonn">+</button>');
    $(".numbers-row")
        .find(".asc")
        .append('<button class="btnquantity buttonn">-</button>');
    // bắt sự kiện click vào nút tăng giảm số lượng trong giỏ hàng
    $(".buttonn").on("click", function () {
        var $button = $(this);
        // lấy giá trị của thẻ input hiển thị
        var oldValue = $button
            .parent()
            .parent()
            .find(".inpqan")
            .find(".inpquantity")
            .val();
        // lấy vị trí. tức là id sản phẩm theo value của input
        var ID_quantity = $button
            .parent()
            .parent()
            .find(".inpqan")
            .find(".ID_Quantity")
            .val();
        // kiểm tra số lượng trên 5 thì không được đặt hàng phải liên hệ tư vấn viên
        if (oldValue >= 5 && $button.text() == "+") {
            Swal.fire({
                icon: "error",
                title: "Thông báo",
                text: "Khách hàng đặt trên 5 sản phẩm vui lòng trao đổi trực tiếp với tư vấn viên. Cảm ơn!",
                footer: '<a href="">Liên hệ</a>',
            });
        } else {
            // nếu là + thì cập nhật input thêm 1 và ngược lại với -
            if ($button.text() == "+") {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                if ($button.text() == "-") {
                    // Don't allow decrementing below zero
                    if (oldValue > 2) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 1;
                    }
                }
            }
            // xử lý tăng giảm bằng file quantity_cart.php
            $.ajax({
                type: "POST",
                url: "api/update-quantity-cart",
                data: {
                    action: "update-quantity",
                    id: ID_quantity,
                    quantity: newVal,
                },
                success: function (response) {
                    if (
                        response.status == 200 &&
                        response.msg == "Update quantity successfully"
                    )
                        location.reload();
                    else {
                        Swal.fire({
                            icon: "error",
                            title: "Thông báo",
                            text: "Đã có lỗi xãy ra xin hãy báo báo cho chúng tôi qua kênh phản hồi!",
                        });
                    }
                },
            });
        }
    });
});
