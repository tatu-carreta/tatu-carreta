@extends($project_name.'-master')

@section('head')@stop
@section('header')@stop

@section('contenido')
<div>
    <h2>Crear Slide</h2>

    {{ Form::open(array('url' => 'admin/slide/agregar', 'files' => true)) }}

    @include('imagen.modulo-galeria-maxi')
    <div class="floatRight">
        <a onclick="cancelarPopup('agregar-seccion');" class="btnGris marginRight5">Cancelar</a>
        <input type="submit" value="Guardar" class="btn">

    </div>
    <div class="clear"></div>

    {{Form::hidden('seccion_id', $seccion_id)}}
    {{Form::hidden('tipo', $tipo)}}
    {{Form::close()}}
</div>
@stop

@section('footer')@stop