$(document).ready(function () {
    $(".like-product").on("click", function () {
        var _idProduct = $(this).parent().find(".idProduct").val();
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
    });
});
