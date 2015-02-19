var menudesplegado = 0;
var niveldesplegado = 0;
var nav = 45;
$(document).ready(function () {

    var slidespeed = 200;
    var navheight = 48;

    $(".parent").on("click", function (e) {

        var hijo = $(this).parent().children("ul");
        var nietos = $(this).parent().find("ul");
        var todos = $(".ancestro").find("ul");
        var sobrinos = $(this).parent().siblings().find("ul");

        var factor = navheight * parseInt($(this).attr("data-nivel"));

        if (hijo.attr("data-desplegado") == "true")
        {

            $("nav").animate({height: factor + "px"}, slidespeed);
            nietos.slideUp(slidespeed);
            nietos.attr("data-desplegado", "false");
            menudesplegado = $(this).attr("data-id");
            niveldesplegado = $(this).attr("data-nivel");
            console.log("plegar los nietos");
        }
        else
        {
            if (menudesplegado != $(this).attr("data-id"))
            {
                $("nav").animate({height: factor + "px"}, slidespeed);
                todos.slideUp(slidespeed);
                todos.attr("data-desplegado", "false");
                menudesplegado = $(this).attr("data-id");
                console.log("plegar los demas");
                factor = factor + navheight;
                $("nav").animate({height: factor + "px"}, slidespeed);
                hijo.slideDown(500);

            }
            else
            {
                if (niveldesplegado == $(this).attr("data-nivel"))
                {
                    $("nav").animate({height: factor + "px"}, slidespeed);
                    sobrinos.slideUp(slidespeed, function () {
                        hijo.slideDown(slidespeed);
                        factor = factor + navheight;
                        $("nav").animate({height: factor + "px"}, slidespeed);
                    });
                    sobrinos.attr("data-desplegado", "false");
                    console.log("plegar los sobrinos");

                }
                else
                {
                    hijo.slideDown(slidespeed);
                    factor = factor + navheight;
                    $("nav").animate({height: factor + "px"});
                }

            }

            console.log("desplegar el hijo");
            niveldesplegado = $(this).attr("data-nivel");
            hijo.attr("data-desplegado", "true");
        }

    });




});