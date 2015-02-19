
<script type="text/javascript">
    $(document).ready(function () {
        $('.file').previewInputFileImage();
        
        $(".imagen").change(function(){
            var id = $(this).attr('data');
            $(".url-archivo"+id).val($(this).val());
        });
        
        $(".cancelarCargaImagen").click(function(){
            var id = $(this).attr('data');
            $("#imagen"+id).val("");
            $(".url-archivo"+id).val("");
            $("#img_principal").attr('src', "{{URL::to('images/sinImg.gif')}}");
        });
    });
</script>
<div class="divCargaImgProducto">
<!--Campos ficticios para enmascarar el file-->

        <label class="btn cargar marginRight5"> Buscar archivo
        <span>
            <input type="file" name="imagen_portada" data-previewer='#img_principal' class='oculto file imagen' data="1" required="true">
        </span>
        </label>
        <input type="text" class="url-archivo1 campoNomArchivo">
        <p>La imagen debe medir mínimo 300 x 300px.</p>
<!-- fin -->

        <div class="divCargaImg marginBottom1">
            <img id="img_principal"  src="{{URL::to('images/sinImg.gif')}}"  alt="Previsualización de Imagen 1">
            <i onclick="" class="cancelarCargaImagen fa fa-times fa-lg" data="1"></i>
        </div>
        @section('modulo-imagen-epigrafe')
            <input class="block anchoTotal marginBottom" type="text" name="epigrafe_imagen_portada" placeholder="Ingrese una descripción de la foto">
        @show
</div>
