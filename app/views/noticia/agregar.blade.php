@extends('item.agregar-general')

@section('funcs')
    <script src="{{URL::to('js/ckeditorLimitado.js')}}"></script>
@stop

@section('titulo_nombre') Título de la noticia @stop

@section('info_nombre') No puede haber dos noticias con igual nombre. Máximo {{$max_length or '...'}} caracteres. @stop

@section('destacado-contenido')
<div class="radio divEstadoNuevo">
    <label>
        <input id="" class="" type="checkbox" name="item_destacado" value="A">
        Destacado
    </label>
</div>
<!-- <p class="infoTxt"><i class="fa fa-info-circle"></i>Los productos NUEVOS y las OFERTAS se muestran también en la home.</p> -->
@stop

@section('bloque-2')

    <!-- Fecha -->
    <div class="col-md-6 divDatos divCargaMarca">
        <h3>Fecha de la noticia</h3>
        <div class="form-group fondoDestacado">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group fondoDestacado">
                        <input class="form-control" type="text" name="fecha"  placeholder="Fecha de la noticia" required="true" maxlength="12">
                    </div>
                </div>
            </div>
            <p class="infoTxt"><i class="fa fa-info-circle"></i>Debe respetar el formato d/m/A</p>
        </div>
    </div>
@stop

@section('bloque-3')
    <!-- Fuente -->
    <div class="col-md-6 divDatos divCargaPrecio">
        <h3>Fuente de la noticia</h3>
        <div class="form-group fondoDestacado">
            <input id="" class="form-control inputWidth60 precio-number" type="text" name="fuente" placeholder="Fuente de la noticia" maxlength="100">
        </div>
    </div>
@stop

@section('mas-datos')
    <!-- Bajada -->
    <div class="col-md-6 divDatos divCargaPrecio">
        <h3>Bajada de la noticia</h3>
        <div class="form-group fondoDestacado">
            <input id="" class="form-control inputWidth60 precio-number" type="text" name="descripcion" placeholder="Bajada de la noticia" maxlength="100">
        </div>
    </div>
@stop

@section('titulo-cuerpo') Cuerpo de la noticia @stop

@section('ubicacion')

    @include('ubicacion.modulo-ubicacion')
    
@stop

@section('hidden')

    {{Form::hidden('seccion_id', $seccion_id)}}
            
@stop