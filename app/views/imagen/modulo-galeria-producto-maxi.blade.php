
<script type="text/javascript">
    $(document).ready(function() {
        $('.file').previewInputFileImage();
    });
</script>

<script type="text/javascript">
        $(document).ready(function() {
            
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

<div class="divCargaImgProducto">
    <!--Campos ficticios para enmascarar el file-->
    <label class="btn cargar marginRight5"> Buscar archivo
            <span>
                <input type="file" name="file[]" data-previewer='#im2' class='oculto file imagen' data="2">
            </span>
    </label>
    <input type="text" class="url-archivo2 campoNomArchivo">
    <p>La imagen debe medir mínimo 300 x 300px.</p>
    <!-- fin -->
    <div class="divCargaImg marginBottom1">
        <img id="im2"  src="{{URL::to('images/sinImg.gif')}}"  alt="Cargar imagen 1">
        <i onclick="" class="cancelarCargaImagen fa fa-times fa-lg" data="2"></i>
    </div>
    <input class="block anchoTotal marginBottom" type="text" name="epigrafe[]" placeholder="Ingrese una descripción de la foto">
</div>
