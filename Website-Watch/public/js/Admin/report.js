$(document).ready(function () {

    let giaTri = 0;
    let intervalId = setInterval(function () {
        giaTri += $("#revenue").val() / 50;
        $(".revenue").text(numeral(giaTri).format("0,0") + " VNĐ");
        if (giaTri >= $("#revenue").val()) {
            clearInterval(intervalId);
        }
    }, 70);
});
