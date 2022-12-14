$(document).ready(function () {
    // Bắt sự kiện click thêm giỏ hàng thêm hiệu ứng animation tới icon giỏ hàng
    $(".add-to-cart").on("click", function () {
        var cart = $(".shopping-cart");
        var imgtodrag = $(this)
            .parent(".product-item-desc-button-submit")
            .parent(".product-item-desc")
            .parent(".product-item")
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
                        url: "api/add-to-cart/" + _productID,
                        success: function (response) {
                            if (
                                response.status == 200 &&
                                response.msg == "Add to cart succes"
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
                            }
                        },
                    });

                    $(this).detach();
                }
            );
        }
    });
});
