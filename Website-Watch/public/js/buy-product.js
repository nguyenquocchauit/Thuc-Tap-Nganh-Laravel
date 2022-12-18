$(document).ready(function () {
    $("#buy-product").on("click", function () {
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
        } else {
        }
    });
});
