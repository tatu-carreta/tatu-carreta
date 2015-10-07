@extends('item.agregar-general')

@section('funcs')
<script src="{{URL::to('js/ckeditorLimitado.js')}}"></script>
@stop

@section('titulo_nombre') Nombre de la muestra @stop

@section('info_nombre') No puede haber dos muestras con igual nombre. Máximo {{$max_legth or '...'}} caracteres. @stop

@section('precio')@stop

@section('archivos')@stop

@section('ubicacion')

    @include('ubicacion.modulo-ubicacion')

@stop

@section('hidden')

    {{Form::hidden('seccion_id', $seccion_id)}}
            
@stop