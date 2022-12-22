$(document).ready(function () {
    $("#btn-create-product").on("click", function () {});

    $(".image-product").change(function () {
        let reader = new FileReader();
        let img = $(this).data("id");
        reader.onload = (e) => {
            $("#" + img + "").attr("src", e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
    });

    // input quantity >0 quantity <10000
    $(document).on("keypress , paste", "#quantity-product", function (e) {
        if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
            let num = $("#quantity-product").val();
            if (num < 0 || num =="-") {
                $("#quantity-product").val(1);
            }
        } else {
            e.preventDefault();
            return false;
        }
    });
    //% of input discount-product
    $(document).on("keypress , paste", "#discount-product", function (e) {
        if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
            $("#discount-product").on("input", function () {
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

    // Currency Separator of input price-product
    var commaCounter = 10;

    function numberSeparator(Number) {
        Number += "";

        for (var i = 0; i < commaCounter; i++) {
            Number = Number.replace(",", "");
        }

        x = Number.split(".");
        y = x[0];
        z = x.length > 1 ? "." + x[1] : "";
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(y)) {
            y = y.replace(rgx, "$1" + "," + "$2");
        }
        commaCounter++;
        return y + z;
    }

    // Set Currency Separator to input fields
    $(document).on("keypress , paste", "#price-product", function (e) {
        if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
            $("#price-product").on("input", function () {
                e.target.value =
                    numberSeparator(e.target.value).replace(" VNĐ", "") +
                    " VNĐ";
            });
        } else {
            e.preventDefault();
            return false;
        }
    });
});
