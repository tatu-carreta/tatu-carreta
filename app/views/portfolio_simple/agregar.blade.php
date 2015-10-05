@extends('item.agregar-general')

@section('nombre')@stop

@section('precio')@stop

@section('archivos')@stop

@section('destacado')@stop

@section('detalles-tecnicos')@stop

@section('modulo_imagen')
    @include('imagen.modulo-imagen-angular-crop-horizontal')
@stop

@section('hidden')

    {{Form::hidden('seccion_id', $seccion_id)}}
    {{Form::hidden('titulo', '')}}
    {{Form::hidden('descripcion', '')}}
            
@stop