jcrop_api = null;
$(document).ready(function () {

    var imagen;
    $("#imagen").on("change", function () {
        var fileReader = new FileReader();
        fileReader.readAsDataURL(this.files[0]);
        nombreImg = this.files[0].name;
        if (jcrop_api != null)
        {
            jcrop_api.destroy();
        }

        fileReader.onloadend = function (event) {
            imagen = event.target.result;
            $("#cropbox").attr("src", event.target.result);
            jcrop_api = $.Jcrop('#cropbox', {
                setSelect: [ 0,0,250,250],
                aspectRatio: 1 / 1,
                onSelect: updateCoords
            });
        }

    });

});


function updateCoords(c)
{
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
}
;
function submitCrop() {
    if (!checkCoords())
    {
        return false;
    }

}

function checkCoords()
{
    if (parseInt($('#w').val()))
        return true;
    alert('Please select a crop region then press submit.');
    return false;
}
;
