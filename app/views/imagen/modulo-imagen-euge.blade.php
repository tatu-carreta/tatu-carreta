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

<div class="marginBottom">
    <input id="imagen" type="file" name="imagen_portada" onChange="validar(this);" required="true">
</div>

<div class="divCargaImg">
    <img id="cropbox" style="width: auto; max-height: 600px;">
</div>
<input class="block anchoTotal marginBottom" type="text" name="epigrafe_imagen_portada" placeholder="Ingrese una descripción de la foto">
<input type="hidden" id="x" name="x">
<input type="hidden" id="y" name="y">
<input type="hidden" id="w" name="w">
<input type="hidden" id="h" name="h">
