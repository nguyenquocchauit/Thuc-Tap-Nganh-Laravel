$(document).ready(function () {
    // viết bình luận hoặc nhận xét
    $(".write-comment-product").on("click", function () {
        var _idUser = $("#ID-User").val();
        var _textComment = $("#text-comment").val();
        var _IDProduct = $("#productID").val();
        var _rating_product = document.getElementsByName("rating-product");
        var _rating = 0;
        // id user có tồn tại (tức đã login) thì thực hiện được action comment product
        if (typeof _idUser === "undefined") {
            Swal.fire({
                icon: "warning",
                title: "Đăng nhập để nhận xét sản phẩm",
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
            for (var i = 0, length = _rating_product.length; i < length; i++) {
                if (_rating_product[i].checked) {
                    // do whatever you want with the checked radio
                    _rating = _rating_product[i].value;
                    // only one radio can be logically checked, don't check the rest
                }
            }
            $.ajax({
                type: "POST",
                url: "/api/comment-product",
                data: {
                    action: "Write comment product",
                    token: _token,
                    product: _IDProduct,
                    user: _idUser,
                    textComment: _textComment,
                    rating: _rating,
                },
                success: function (response) {
                    if (
                        response.status == 200 &&
                        response.msg == "Write comment successfully"
                    ) {
                        var _html = "";
                        _html += '<div class="d-flex flex-start p-1">';
                        _html +=
                            '<img class="rounded-circle shadow-1-strong me-3" src="/images/avt-comment.webp" alt="avatar" width="65" height="65" />';
                        _html += '<div class="card w-100">';
                        _html += '<div class="card-body p-4">';
                        _html += '<div class="">';
                        _html += '<div class="row">';
                        _html += '<div class="col-6">';
                        _html +=
                            " <h5><strong>" +
                            response.author["name"] +
                            "</strong></h5>";
                        _html += "</div>";
                        _html += '<div class="col-6">';
                        _html +=
                            '<span class="d-flex justify-content-end"><i class="fas fa-trash-alt"></i></span>';
                        _html += "</div>";
                        _html += " <p> ";
                        for (let i = 1; i <= 5; i++) {
                            if (i <= response.data["star"]) {
                                _html += '<span class="color_red">☆</span>';
                            } else {
                                _html += '<span class="">☆</span>';
                            }
                        }
                        _html += " </p>";
                        _html +=
                            '<p class="small"> ' +
                            response.data["created_at"] +
                            "</p>";
                        _html += "<p> " + response.data["content"] + " </p>";
                        _html +=
                            '<div class="d-flex justify-content-between align-items-center">';
                        _html += '<div class="d-flex align-items-center">';
                        _html +=
                            '<a href="#!" class="link-muted me-2"><i class="fas fa-thumbs-up me-1"></i>132</a>';
                        _html +=
                            '<a href="#!" class="link-muted"><i class="fas fa-thumbs-down me-1"></i>15</a>';
                        _html += "</div>";
                        _html +=
                            '<a href="#!" class="link-muted"><i class="fas fa-reply me-1"></i> Trả lời</a>';
                        _html += "</div>";
                        _html += "</div>";
                        _html += " </div>";
                        _html += " </div>";
                        _html += "  </div>";
                        $(".show-comment-ajax").html(_html);
                    }
                },
            });
        }
    });
    // xóa bình luận
    $(".delete-comment-product").on("click", function () {
        var _idComment = $(this).parent().find("#IDComment").val();
        Swal.fire({
            title: "Bạn có chắc muốn xóa bình luận?",
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
                    url: "/api/delete-comment",
                    data: {
                        action: "Delete comment product",
                        token: _token,
                        IDComment: _idComment,
                    },
                    success: function (response) {
                        console.log(response);
                        if (
                            response.status == 200 &&
                            response.msg == "Delete comment successfully"
                        ) {
                            Swal.fire({
                                icon: "success",
                                title: "Xóa thành công!",
                                timer: 1500,
                                timerProgressBar: true,
                            }).then((result) => {
                                // done then reload page
                                if (
                                    result.dismiss === Swal.DismissReason.timer
                                ) {
                                    location.reload();
                                }
                            });
                        }
                    },
                });
            }
        });
    });
    // xóa nội dung bình luận, tức là hủy không muốn bình luận nữa
    $(".cancel-comment-product").on("click", function () {
        $("#text-comment").val("");
    });
});
