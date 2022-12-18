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
                    action: "Like comment product",
                    token: _token,
                    product: _idProduct,
                    user: $("#ID-User").val(),
                },
                success: function (response) {
                    var x = ".product-" + _idProduct;
                    if (
                        response.status == 200 &&
                        response.msg == "Unlike product successfully"
                    ) {
                        $(x).removeClass("liked");
                    } else {
                        if (
                            response.status == 200 &&
                            response.msg == "Like product successfully"
                        ) {
                            $(x).addClass("liked");
                        }
                    }
                },
            });
        }
    });
});
