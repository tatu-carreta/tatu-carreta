$(document).ready(function () {
    setTimeout(function () {
        $(".divAlerta").fadeOut(1500);
    }, 10000);
});
$(function () {
    $(".cerrarDivAlerta").click(function () {
        $(".divAlerta").fadeOut(1500);
    });
});