<script>
    $(document).ready(function() {
        $('.archivo').change(function(){
            var id = $(this).attr('data');
            $('.url-file'+id).val($(this).val());
        });
    });
</script>

<!--Campos ficticios para enmascarar el file-->
    <input type="text" class="url-file1" class="anchoTotal">

    <label class="btn cargar marginRight"> Seleccionar archivo
    <span>
        <input type="file" accept="application/pdf" name="archivo[]" class='oculto file archivo' data="1">
    </span>
    </label>
<!-- fin -->
<div class="clear"></div>

<!--Campos ficticios para enmascarar el file-->
    <input type="text" class="url-file2" class="anchoTotal">

    <label class="btn cargar marginRight"> Seleccionar archivo
    <span>
        <input type="file" accept="application/pdf" name="archivo[]" class='oculto file archivo' data="2">
    </span>
    </label>
<!-- fin -->
<div class="clear"></div>