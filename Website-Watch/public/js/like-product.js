$(document).ready(function () {
    $(".like-product").on("click", function () {
        var _idProduct = $(this).parent().find(".idProduct").val();
        // id user có tồn tại (tức đã login) thì thực hiện được action like product
        if (typeof $("#ID-User").val() === "undefined") {
            Swal.fire({
                icon: "warning",
                title: "Đăng nhập để thích sản phẩm",
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
                url: "/api/like-product",
                data: {
                    action: "Like product",
                    token: _token,
                    product: _idProduct,
                    user: $("#ID-User").val(),
                },
                success: function (response) {
                    var x = ".product-" + _idProduct;
                    var remove = ".product--" + _idProduct;
                    if (
                        response.status == 200 &&
                        response.msg == "Unlike product successfully"
                    ) {
                        $(x).removeClass("liked");
                        $(remove).remove();
                    } else {
                        if (
                            response.status == 200 &&
                            response.msg == "Like product successfully"
                        ) {
                            var _image = response.image;
                            var _price =
                                response.data.price -
                                response.data.price *
                                    (response.data.discount / 100);
                            _price = _price.toLocaleString("it-IT", {
                                style: "currency",
                                currency: "VND",
                            });
                            $(x).addClass("liked");
                            $("#row_wishlist").append(
                                '<div class="row product--' +
                                    response.data.id +
                                    '" style="margin: 10px 0"><div class="col-md-4"><img src="/images/image_products_home/' +
                                    _image +
                                    '" width="100%"></div><div class="col-md-8" info_wishlist><p>' +
                                    response.data.name +
                                    '</p><p style="color:#fe980f">' +
                                    _price +
                                    '</p><a class="btn btn-success"  href="/chi-tiet-san-pham/' +
                                    response.data.id +
                                    '">Chi tiết</a><a class="btn btn-danger btn-xs delete_wishlist remove-like-product"style="margin-top:0">Xóa</a><input type="hidden" class="idProduct" value="' +
                                    response.data.id +
                                    '"></div></div>'
                            );
                        }
                    }
                },
            });
        }
    });
    $(".remove-like-product").on("click", function () {
        var _idProduct = $(this).parent().find(".idProduct").val();
        console.log(_idProduct);
        $.ajax({
            type: "POST",
            url: "/api/like-product",
            data: {
                action: "Like product",
                token: _token,
                product: _idProduct,
                user: $("#ID-User").val(),
            },
            success: function (response) {
                var remove = ".product--" + _idProduct;
                var x = ".product-" + _idProduct;
                if (
                    response.status == 200 &&
                    response.msg == "Unlike product successfully"
                ) {
                    $(x).removeClass("liked");
                    $(remove).remove();
                }
            },
        });
    });
    $("#clear-like-product").on("click", function () {
        $.ajax({
            type: "POST",
            url: "/api/clear-like",
            data: {
                action: "Clear like product",
                token: _token,
                user: $("#ID-User").val(),
            },
            success: function (response) {
                if (
                    response.status == 200 &&
                    response.msg == "Clear like successfully"
                ) {
                    for (
                        let index = 0;
                        index < response.product.length;
                        index++
                    ) {
                        var x = ".product-" + response.product[index].product;
                        $(x).removeClass("liked");
                    }
                    $("#row_wishlist").children("div").remove();
                }
            },
        });
    });
});
