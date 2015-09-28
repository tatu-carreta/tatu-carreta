<script>
    $(document).ready(function() {
        $('.archivo').change(function(){
            var id = $(this).attr('data');
            $('.url-file'+id).val($(this).val());
        });
    });
</script>

<div class="row marginBottom1">
    <div class="col-md-8">
        <input type="text" class="url-file1 form-control">
    </div>
    <div class="col-md-4">
        <label class="btn btn-primary"> Seleccionar archivo
            <span>
                <input id="fileInput" type="file" accept="application/pdf" name="archivo[]" class='oculto file archivo' data="1">
            </span>
        </label>
    </div>
</div>

<div class="row marginBottom1">
    <div class="col-md-8">
        <input type="text" class="url-file2 form-control">
    </div>
    <div class="col-md-4">
        <label class="btn btn-primary"> Seleccionar archivo
            <span>
                <input id="fileInput" type="file" accept="application/pdf" name="archivo[]" class='oculto file archivo' data="2">
            </span>
        </label>
    </div>
</div>

<div class="row marginBottom1">
    <div class="col-md-8">
        <input type="text" class="url-file3 form-control">
    </div>
    <div class="col-md-4">
        <label class="btn btn-primary"> Seleccionar archivo
            <span>
                <input id="fileInput" type="file" accept="application/pdf" name="archivo[]" class='oculto file archivo' data="3">
            </span>
        </label>
    </div>
</div>
