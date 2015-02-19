
<script type="text/javascript">
    $(document).ready(function() {
        $('.file').previewInputFileImage();
        
        $(".imagen").change(function(){
            var id = $(this).attr('data');
            $(".url-archivo"+id).val($(this).val());
        });
        
        $(".cancelarCargaImagen").click(function(){
            var id = $(this).attr('data');
            $("#imagen"+id).val("");
            $(".url-archivo"+id).val("");
            $("#im"+id).attr('src', "{{URL::to('images/sinImg.gif')}}");
        });
    });
</script>

<div class="fondoDestacado padding1 marginBottom2 col50">
    <h3>Imagen de marca</h3>
    <div class="floatLeft" style="margin-top:40px">
    <!--Campos ficticios para enmascarar el file-->

            <label class="btn cargar marginRight5"> Buscar archivo
            <span>
                <input id="imagen1" type="file" name="file" data-previewer='#im1' class='oculto file imagen'  required="true" data="1">
            </span>
            </label>
            <input type="text" class="url-archivo1 campoNomArchivo">
            <p style="margin-top:0">La imagen debe medir como mínimo 150 x 150px.</p>
    <!-- fin -->
    </div>
    <div class="divCargaMarca floatRight">
        <img id="im1" src="{{URL::to('images/sinImg.gif')}}" alt="Cargar imagen 1">
        <i onclick="" class="cancelarCargaImagen fa fa-times fa-lg" data="1"></i>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>