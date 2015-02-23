
$(document).ready(function () {
    if ($('.precioDisabled').attr('checked'))
    {
        $('.precioAble').removeAttr('disabled');
        $('.precioAble').attr('required', 'true');
    }
    $(".imagenEditarNone").removeAttr('required');
    $(".destacadoEditarNone").removeAttr('checked');
});

$(function () {
    $('.class_checkbox').click(function (e) {
        e.preventDefault();
        if (!$('.precioDisabled').attr('checked'))
        {
            $(this).children(":first").addClass('tocado');
            $(this).children(":first").removeClass('noTocado');
            $('.precioAble').removeAttr('disabled');
            $('.precioAble').attr('required', 'true');
            $('.precioDisabled').attr('checked', 'true');
            $('.precioAble').focus();
        }
        else
        {
            $(this).children(":first").addClass('noTocado');
            $(this).children(":first").removeClass('tocado');
            $('.precioAble').attr('disabled', 'disabled');
            $('.precioAble').removeAttr('required');
            $('.precioDisabled').removeAttr('checked');
            $('.precioAble').focusout();
        }
    });

    $(".selectMarca").change(function () {
        var id = $(".selectMarca option:selected").val();
        if (id != "")
        {
            $.post("{{URL::to('admin/marca/imagen')}}", {'marca_id': id}, function (data) {
                $(".marca_imagen_preview").html(data);
            });
        }
        else
        {
            $(".marca_imagen_preview").html("");
        }
    });
});
