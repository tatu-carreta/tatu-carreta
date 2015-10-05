<script>
    $(document).ready(function() {
        $('.archivo').change(function(){
            var id = $(this).attr('data');
            $('.url-file'+id).val($(this).val());
        });
    });
</script>
@if(count($item->archivos) > 0)
    @foreach($item->archivos as $archivo)
    <div>
        <a class="descargarPDF">{{$archivo->titulo}}</a>
        <a class="btn btn-link" onclick="borrarImagenReload('{{ URL::to('admin/archivo/borrar') }}', '{{$archivo->id}}');"><i class="fa fa-times fa-lg"></i></a>
    </div>
    @endforeach
@endif
@if(count($item->archivos) == 2)
    <div class="row marginBottom1">
        <div class="col-md-12 divInputFile"> 
            <label class="btn btn-primary"> Seleccionar archivo
                <span>
                    <input id="fileInput" type="file" accept="application/pdf" name="archivo[]" class='oculto file archivo' data="1">
                </span>
            </label>
            <input type="text" class="url-file1 form-control">
        </div>
    </div>
@elseif(count($item->archivos) == 1)
    <div class="row marginBottom1">
        <div class="col-md-12 divInputFile">
            <label class="btn btn-primary"> Seleccionar archivo
                <span>
                    <input id="fileInput" type="file" accept="application/pdf" name="archivo[]" class='oculto file archivo' data="1">
                </span>
            </label>
            <input type="text" class="url-file1 form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 divInputFile">
            <label class="btn btn-primary"> Seleccionar archivo
                <span>
                    <input id="fileInput" type="file" accept="application/pdf" name="archivo[]" class='oculto file archivo' data="2">
                </span>
            </label>
            <input type="text" class="url-file2 form-control">
        </div>
    </div>
@elseif(count($item->archivos) == 0)
   <div class="row marginBottom1">
        <div class="col-md-12 divInputFile">
            <label class="btn btn-primary"> Seleccionar archivo
                <span>
                    <input id="fileInput" type="file" accept="application/pdf" name="archivo[]" class='oculto file archivo' data="1">
                </span>
            </label>
            <input type="text" class="url-file1 form-control">
        </div>
    </div>
    <div class="row marginBottom1">
        <div class="col-md-12 divInputFile">
            <label class="btn btn-primary"> Seleccionar archivo
                <span>
                    <input id="fileInput" type="file" accept="application/pdf" name="archivo[]" class='oculto file archivo' data="2">
                </span>
            </label>
            <input type="text" class="url-file2 form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 divInputFile">
            <label class="btn btn-primary"> Seleccionar archivo
                <span>
                    <input id="fileInput" type="file" accept="application/pdf" name="archivo[]" class='oculto file archivo' data="3">
                </span>
            </label>
            <input type="text" class="url-file3 form-control">
        </div>
    </div>
@endif