$(document).ready(function () {
    // message error
    function showMsgWaring(msg, vali) {
        Swal.fire({
            icon: "warning",
            title: msg,
            timer: 2000,
            timerProgressBar: true,
        });
        $(vali).addClass("is-invalid");
    }
    // delete product
    $(".btn-delete-product").on("click", function () {
        let id = $(this).find("input").val();
        Swal.fire({
            title: "Bạn có chắc muốn xóa sản phẩm này?",
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
                    type: "GET",
                    url: "/api/admin/product/delete/" + id,
                    success: function (response) {
                        if (
                            response.status == 200 &&
                            response.msg == "Delete product successfully"
                        ) {
                            window.location.href = "/admin/product";
                        }
                    },
                });
            }
        });
    });
    //create product
    $("#btn-create-product").on("click", function () {
        let count = 0;
        var formData = new FormData($("#create-product")[0]);
        if (checkForm("#create-product"))
            if (formData.has("image[]")) {
                // For further check, you must enter all 6 photos
                var images = formData.getAll("image[]");
                for (var i = 0; i < images.length; i++) {
                    if (!images[i].name) {
                        showMsgWaring("Vui lòng nhập ảnh!", ".image_product");

                        break;
                    } else count = count + 1;
                }
            }
        // count =6 is full 6 input image
        if (count == 6) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                url: "/api/admin/product/create",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (
                        response.status == 200 &&
                        response.msg == "Create product successfully"
                    ) {
                        Swal.fire({
                            icon: "success",
                            title: "Tạo sản phẩm thành công!",
                            timer: 2000,
                            timerProgressBar: true,
                        }).then((result) => {
                            window.location.href =
                                "/admin/product/" + response.id + "/edit";
                        });
                    } else if (
                        response.status == 422 &&
                        response.msg == "Up to 99% discount"
                    ) {
                        showMsgWaring(
                            "Giảm giá tối đa 99%!",
                            "#discount_product"
                        );
                    } else if (
                        response.status == 422 &&
                        response.msg == "Minimum selling price 100,000 VND"
                    ) {
                        showMsgWaring(
                            "Giá bán tối thiểu 100.000 VNĐ hoặc dưới 1 tỷ!",
                            "#price_product"
                        );
                    } else if (
                        response.status == 422 &&
                        response.msg == "Duplicate name"
                    ) {
                        showMsgWaring(
                            "Đã có sản phẩm tên tương tự!",
                            "#name_product"
                        );
                    }
                },
            });
        }
    });
    //update product
    $("#btn-update-product").on("click", function () {
        let id = $(this).find("input").val();
        var formData = new FormData($("#update-product")[0]);
        checkForm("#update-product");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: "/api/admin/product/update/" + id,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if (
                    response.status == 200 &&
                    response.msg == "Update product successfully"
                ) {
                    Swal.fire({
                        icon: "success",
                        title: "Cập nhật thành công!",
                        timer: 2000,
                        timerProgressBar: true,
                    }).then((result) => {
                        location.reload();
                    });
                } else if (
                    response.status == 500 &&
                    response.msg == "Up to 99% discount"
                ) {
                    showMsgWaring("Giảm giá tối đa 99%!", "#discount_product");
                } else if (
                    response.status == 500 &&
                    response.msg == "Minimum selling price 100,000 VND"
                ) {
                    showMsgWaring(
                        "Giá bán tối thiểu 100.000 VNĐ hoặc dưới 1 tỷ!",
                        "#price_product"
                    );
                } else if (
                    response.status == 500 &&
                    response.msg == "Duplicate name"
                ) {
                    showMsgWaring(
                        "Đã có sản phẩm tên tương tự!",
                        "#name_product"
                    );
                }
            },
        });
    });
    // review image product
    $(document).on("change", ".image_product", function () {
        let reader = new FileReader();
        let img = $(this).data("id");
        // check format file image
        let file = this.files[0];
        let fileType = file["type"];
        let validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            showMsgWaring(
                "Chỉ cho phép định dạng ảnh jpg,png,jpeg",
                ".file-image"
            );
            $(this).val("");
            return false;
        }

        reader.onload = (e) => {
            $("#" + img + "").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });

    // input quantity >0 quantity <10000
    $(document).on("keypress , paste", "#quantity_product", function (e) {
        if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
            $("#quantity_product").on("input", function () {
                let num = $("#quantity_product").val();
                num = parseInt(num, 10);
                if (Number.isNaN(num)) {
                    $("#quantity_product").val(0);
                } else {
                    if (num < 0 || num == "-" || num > 1000) {
                        $("#quantity_product").val(0);
                    } else {
                        $("#quantity_product").val(num);
                    }
                }
            });
        } else {
            e.preventDefault();
            return false;
        }
    });

    //% of input discount_product
    $(document).on("keypress , paste", "#discount_product", function (e) {
        if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
            $("#discount_product").on("input", function () {
                let num = $(this).val();
                num = num.replace("%", "");
                if (num <= 100) {
                    $(this).val(function (i, v) {
                        return v.replace("%", "") + "%";
                    });
                } else {
                    num = num.substring(0, num.length - 1);
                    $(this).val(num + "%");
                }
            });
        } else {
            e.preventDefault();
            return false;
        }
    });

    // Set Currency Separator to input fields

    $("#price_product").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        },
    });

    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.

        // get input value
        var input_val = input.val();

        // don't validate empty input
        if (input_val === "") {
            return;
        }
        // original length
        var original_len = input_val.length;

        // initial caret position
        var caret_pos = input.prop("selectionStart");

        // check for decimal
        if (input_val.indexOf(".") >= 0) {
            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);

            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
                right_side += "00";
            }

            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = left_side + "." + right_side + " VNĐ";
        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = input_val + " VNĐ";
        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }

    // check validation form create and edit product
    function checkForm(form) {
        var formData = new FormData($(form)[0]);
        var keys = [
            "name_product",
            "brand_id",
            "product_category_id",
            "price_product",
            "discount_product",
            "quantity_product",
            "description_product",
        ];
        for (var i = 0; i < keys.length; i++) {
            if (!(formData.has(keys[i]) && formData.get(keys[i]))) {
                if (i == 0) {
                    showMsgWaring(
                        "Vui lòng nhập tên sản phẩm!!!",
                        "#name_product"
                    );
                    break;
                }
                if (i == 1) {
                    showMsgWaring(
                        "Vui lòng chọn hãng sản phẩm!!!",
                        "#brand_id"
                    );
                    break;
                }
                if (i == 2) {
                    showMsgWaring(
                        "Vui lòng chọn loại!!!",
                        "#product_category_id"
                    );
                    break;
                }
                if (i == 3) {
                    showMsgWaring(
                        "Vui lòng nhập giá sản phẩm!!!",
                        "#price_product"
                    );
                    break;
                }
                if (i == 4) {
                    showMsgWaring(
                        "Vui lòng nhập giảm giá sản phẩm!!!",
                        "#discount_product"
                    );
                    break;
                }
                if (i == 5) {
                    showMsgWaring(
                        "Vui lòng nhập số lượng sản phẩm!!!",
                        "#quantity_product"
                    );
                    break;
                }
                if (i == 6) {
                    showMsgWaring(
                        "Vui lòng nhập mô tả sản phẩm!!!",
                        "#description_product"
                    );
                    break;
                }
            }
            if (i == 6) return true;
        }
        return false;
    }
});
