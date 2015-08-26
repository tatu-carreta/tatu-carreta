<script src="{{URL::to('js/moduleImageCrop.js')}}"></script>
<style type="text/css">
    #target {
        background-color: #ccc;
        width: 500px;
        height: 330px;
        font-size: 24px;
        display: block;
    }


</style>
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

<div class="marginBottom1">
	<label class="btn btn-primary cargar marginRight5"> Buscar archivo
            <span>
    			<input id="imagen" type="file" name="imagen_portada" class='oculto file imagen' onChange="validar(this);" required="true" >
    		</span>
    </label>
    <input type="text" class="url-archivo1 campoNomArchivo">
</div>


<div class="divCargaImg marginBottom1">
    <img id="cropbox" style="width: auto; max-height: 250px;">
</div>
<input class="form-control" type="text" name="epigrafe_imagen_portada" placeholder="Ingrese una descripción de la foto">
<input type="hidden" id="x" name="x">
<input type="hidden" id="y" name="y">
<input type="hidden" id="w" name="w">
<input type="hidden" id="h" name="h">
