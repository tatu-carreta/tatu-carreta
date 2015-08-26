$(document).ready(function () {
    setTimeout(function () {
        $(".divEmergente").fadeOut(1500);
    }, 10000);
});
$(function () {
    $(".cerrarEmergente").click(function () {
        $(".divEmergente").fadeOut(1500);
    });
});