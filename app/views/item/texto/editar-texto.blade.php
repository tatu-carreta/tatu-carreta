@extends($project_name.'-master')

@section('head')@stop
@section('header')@stop

@section('contenido')
    <script src="{{URL::to('js/ckeditorLimitado.js')}}"></script>
    <div>
        <h2>carga y modificación de textos</h2>

        {{ Form::open(array('url' => 'admin/texto/editar')) }}

            <input class="block anchoTotal marginBottom" type="text" name="titulo" placeholder="Título" value="{{$item->titulo}}">
            <div class="divEditorTxt">
                <textarea id="texto" contenteditable="true" class="" name="cuerpo">{{ $texto->cuerpo }}</textarea>
            </div>
            <div class="floatRight">
                <a onclick="cancelarPopup('agregar-seccion');" class="btnGris marginRight5">Cancelar</a>
                <input type="submit" value="Guardar" class="btn">

            </div>
            <div class="clear"></div>

            {{Form::hidden('texto_id', $texto->id)}}
            {{Form::hidden('id', $item->id)}}
        {{Form::close()}}
    </div>
@stop

@section('footer')@stop