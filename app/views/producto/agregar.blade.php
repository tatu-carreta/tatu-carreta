@extends('item.agregar-general')

@section('funcs')

<script>
    $(function(){
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
    
</script>
<script src="{{URL::to('js/ckeditorLimitado.js')}}"></script>
<script src="{{URL::to('js/producto-funcs.js')}}"></script>

@stop

@section('titulo_nombre') Nombre de producto @stop

@section('marca')

    <!-- Marca -->
    <div class="col-md-6 divDatos divCargaMarca">
        <h3>Marca</h3>
        <div class="form-group fondoDestacado">
            <div class="row">
                <div class="col-md-9">
                    <select class="form-control selectMarca" name="marca_principal" id="marca_principal">
                        <option value="">Seleccione una Marca</option>
                        @foreach($marcas_principales as $marca)
                            <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="marca_imagen_preview"></div>
                </div>
            </div>


            <!-- <input class="form-control" type="text" name="titulo" placeholder="Código" required="true" maxlength="9"> -->
            <p class="infoTxt"><i class="fa fa-info-circle"></i>...</p>
        </div>
    </div>
@stop

@section('precio')

    <!-- Precio -->
    <div class="col-md-6 divDatos divCargaPrecio">
        <h3>Precio</h3>
        <div class="form-group fondoDestacado">
            <input id="" class="form-control inputWidth60 precio-number" type="text" name="precio" value="">
            <!-- <input class="form-control" type="text" name="titulo" placeholder="Código" required="true" maxlength="9"> -->
            <p class="infoTxt"><i class="fa fa-info-circle"></i>...</p>
        </div>
    </div>

@stop

@section('ubicacion')

    @include('ubicacion.modulo-ubicacion')
    
@stop

@section('hidden')

    {{Form::hidden('seccion_id', $seccion_id)}}
    {{Form::hidden('descripcion', '')}}
    {{Form::hidden('tipo_precio_id[]', '2')}}
            
@stop