$(document).ready(function () {
    // Bắt sự kiện click thêm giỏ hàng thêm hiệu ứng animation tới icon giỏ hàng
    $(".add-to-cart").on("click", function () {
        var cart = $(".shopping-cart");
        var imgtodrag = $(this)
            .parent()
            .parent()
            .parent()
            .find(".product-item-img")
            .find("img")
            .eq(0);
        // tìm đúng các value của phần tử theo vị trí nút button được click
        var _productID = $(this)
            .parent(".product-item-desc-button-submit")
            .find(".productID")
            .val();
        var _productName = $(this)
            .parent(".product-item-desc-button-submit")
            .find(".productName")
            .val();
        var _productImage = $(this)
            .parent(".product-item-desc-button-submit")
            .find(".productImage")
            .val();
        if (imgtodrag) {
            // tạo phần tử sao chép giống phần tử cha. Tức là copy ra 1 ảnh như vậy

            var imgclone = imgtodrag
                .clone()
                .offset({
                    //offset lấy vị trí top & left của img gốc
                    top: imgtodrag.offset().top,
                    left: imgtodrag.offset().left,
                })
                .css({
                    // thiết lập css
                    opacity: "0.5",
                    position: "absolute",
                    height: "250px",
                    width: "200px",
                    "z-index": "100",
                })
                .appendTo($("body") /* thêm vào body hiển thị ra giao diện*/)
                .animate(
                    {
                        // animation cho img tới giỏ hàng
                        top: cart.offset().top + 10,
                        left: cart.offset().left + 10,
                        width: 75,
                        height: 75,
                        position: "absolute",
                    },
                    1000
                );
            imgclone.animate(
                {
                    width: 0,
                    height: 0,
                },
                function () {
                    $.ajax({
                        type: "GET",
                        url: "/api/add-to-cart/" + _productID,
                        success: function (response) {
                            console.log(response);
                            if (
                                response.status == 200 &&
                                response.msg == "Add to cart successfully"
                            ) {
                                Swal.fire({
                                    position: "top-end",
                                    //icon: 'success',
                                    imageUrl:
                                        "/images/image_products_home/" +
                                        _productImage,
                                    imageWidth: 70,
                                    imageHeight: 90,
                                    title:
                                        "Đã thêm sản phẩm " +
                                        _productName.toLowerCase() +
                                        " vào giỏ hàng!",
                                    showConfirmButton: false,
                                    timer: 1300,
                                }).then((result) => {
                                    // done then show quantity in cart product
                                    document.getElementById(
                                        "quantity-shopping-cart"
                                    ).innerHTML = response.quantity_cart;
                                });
                            } else if (
                                response.status == 500 &&
                                response.msg == "Passed the number above 5"
                            ) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Thông báo",
                                    text: "Khách hàng đặt trên 5 sản phẩm vui lòng trao đổi trực tiếp với tư vấn viên. Cảm ơn!",
                                    footer: '<a href="">Liên hệ</a>',
                                });
                            } else if (
                                response.status == 422 &&
                                response.msg == "Out of stock"
                            ) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Thông báo",
                                    text: "Sản phẩm đã hết hàng!",
                                });
                            }
                        },
                    });

                    $(this).detach();
                }
            );
        }
    });
    // bắt sự kiện click mua hàng
    $("#order-product").on("click", function () {
        var _productID = $("#productID").val();
        $.ajax({
            type: "GET",
            url: "/api/add-to-cart/" + _productID,
            success: function (response) {
                console.log(response);
                if (
                    response.status == 200 &&
                    response.msg == "Add to cart successfully"
                ) {
                    window.location.href = "/gio-hang";
                } else if (
                    response.status == 500 &&
                    response.msg == "Passed the number above 5"
                ) {
                    Swal.fire({
                        icon: "error",
                        title: "Thông báo",
                        text: "Khách hàng đặt trên 5 sản phẩm vui lòng trao đổi trực tiếp với tư vấn viên. Cảm ơn!",
                        footer: '<a href="">Liên hệ</a>',
                    });
                } else if (
                    response.status == 422 &&
                    response.msg == "Out of stock"
                ) {
                    Swal.fire({
                        icon: "error",
                        title: "Thông báo",
                        text: "Sản phẩm đã hết hàng!",
                    });
                }
            },
        });
    });
    $("body").on("click", "#buy-all-like-product", function () {
        var idArr = [];
        // get id produc form list like product
        $(".list-like-product").each(function () {
            idArr.push($(this).data("id"));
        });
        // if check < idArr.length means the user bought the product in excess of the allowed quantity
        var check = 0;
        for (let index = 0; index < idArr.length; index++) {
            $.ajax({
                type: "GET",
                url: "/api/add-to-cart/" + idArr[index],
                success: function (response) {
                    if (
                        response.status == 500 &&
                        response.msg == "Passed the number above 5"
                    ) {
                    }
                },
            });
            check++;
        }
        if ((check = idArr.length)) {
            window.location.href = "/gio-hang";
        }
    });
});
