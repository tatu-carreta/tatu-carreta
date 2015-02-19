@extends($project_name.'-master')

@section('head')@stop
@section('header')@stop

@section('contenido')
<div class="modal">
    {{ Form::open(array('url' => 'admin/producto/destacar')) }}
    <h2>destacar producto</h2>
    <input class="block anchoTotal marginBottom" type="text" name="precio" placeholder="Precio" required="true">
    <div class="floatRight">
        <a onclick="cancelarPopup('destacar-producto');" class="btnGris marginRight5">Cancelar</a>
        <input type="submit" value="Guardar" class="btn">
    </div>
    {{Form::hidden('continue', $continue)}}
    {{Form::hidden('producto_id', $producto->id)}}
    {{Form::close()}}
</div>
@stop

@section('footer')@stop