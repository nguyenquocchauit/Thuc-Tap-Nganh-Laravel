$(document).ready(function () {
    let interval = setInterval(function () {
        $(".icon-check").animate({ marginTop: "-=20px" }, 500);
        $(".icon-check").animate({ marginTop: "+=20px" }, 500);
        if (
            $(".icon-check")
                .parent(".card-body")
                .find(".d-inline-block")
                .find("input")
                .val() == 0
        )
            clearInterval(interval);
    }, 100);

    let giaTri = 0;
    let intervalId = setInterval(function () {
        giaTri += $("#revenue").val() / 50;
        $(".revenue").text(numeral(giaTri).format("0,0") + " VNĐ");
        if (giaTri >= $("#revenue").val()) {
            clearInterval(intervalId);
        }
    }, 70);
});
