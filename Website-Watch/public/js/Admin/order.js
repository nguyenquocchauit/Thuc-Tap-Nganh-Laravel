$(document).ready(function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("customer") && urlParams.get("customer") !== "") {
        $("#order-detail").addClass("active");
        $("#order").removeClass("active");
        var a_detail = $("#order-detail").data("id");
        var a_order = $("#order").data("id");
        $("." + a_order + "").removeClass("active");
        $("." + a_detail + "").addClass("active");
    }
    if (window.location.href.indexOf("customer=") > -1) {
        $("#order-detail").addClass("active");
        $("#order").removeClass("active");
        var a_detail = $("#order-detail").data("id");
        var a_order = $("#order").data("id");
        $("." + a_order + "").removeClass("active");
        $("." + a_detail + "").addClass("active");
    }
    $(document).on("change", "#status", function () {
        Swal.fire({
            title:
                "Bạn chắc chắn muốn cập nhật đơn hàng sang trạng thái " +
                $(this).find("option:selected").text() +
                "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý",
            cancelButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) {
                let idOrder = $(this).parent("div").find("input").val();
                console.log(this.value);
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "POST",
                    url: "api/admin/order/status/" + idOrder,
                    data: {
                        statusOrder: this.value,
                    },
                    success: function (response) {
                        if (
                            response.status == 200 &&
                            response.msg == "Update status successfully"
                        ) {
                            Swal.fire({
                                icon: "success",
                                title: "Cập nhật thành công!",
                                timer: 2000,
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

    $(".status").change(function () {
        var selectedValue = $(this).val();
        $(this)
            .removeClass("select-dvc select-tc select-tb select-xn")
            .addClass("select-" + selectedValue.toLowerCase());
    });
});
