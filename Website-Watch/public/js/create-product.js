$(document).ready(function () {

    $("#btn-create-product").on("click", function () {});

    $('.image-product').change(function(){
        var file = $(this).files[0];
        console.log(file);
    });
});
