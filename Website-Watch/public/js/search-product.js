$(document).ready(function () {
    $("#search-product").keyup(function () {
        $.ajax({
            type: "GET",
            url: "/api/search-product/" + $("#search-product").val(),
            success: function (response) {
                var _html = "";
                for (var pro of response.data) {
                    var _price = pro.price;
                    _price = _price.toLocaleString("it-IT", {
                        style: "currency",
                        currency: "VND",
                    });
                    _html += '<div class="row">';
                    _html += '   <div class="col-2">';
                    _html +=
                        "<img class='imgSearch' src='/images/image_products_home/" +
                        pro.image +
                        "-1.png'>";
                    _html += " </div>";
                    _html += '<div class="col-10">';
                    _html +=
                        '<div class="row rowName"><a href="/chi-tiet-san-pham/' +
                        pro.id +
                        '">' +
                        pro.name +
                        "</a></div>";
                    _html += '<div class="row rowPrice">' + _price + "</div>";
                    _html += "</div>";
                    _html += "</div>";
                }
                $("#searchResult").html(_html);
            },
            error: function (response) {},
        });
    });
});
