@extends($project_name.'-master')

@section('head')@stop
@section('header')@stop

@section('contenido')
<div>
    <script>
        $(function () {
            $('.sortable').sortable();
        });</script>
    {{ Form::open(array('url' => 'admin/seccion/ordenar-por-menu', 'id' => 'ordenar')) }}

    <ul class="sortable">
        @foreach($secciones as $seccion)
        <li id="{{$seccion->id}}"><span><b>Sección:</b> <strong>{{ $seccion->id }}</strong> {{ $seccion -> titulo }}</span><input type="hidden" name="orden[]" value="{{$seccion->id}}"></li><br>
        @endforeach
    </ul>
    {{Form::hidden('menu_id', $menu->id)}}
    <div class="floatRight">
        <a onclick="cancelarPopup('agregar-seccion');" class="btnGris marginRight5">Cancelar</a>
        <input type="submit" value="Guardar" class="btn">
    </div>

    {{Form::close()}}
</div>
@stop

@section('footer')@stop