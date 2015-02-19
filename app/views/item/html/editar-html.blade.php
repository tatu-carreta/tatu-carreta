@extends($project_name.'-master')

@section('head')@stop
@section('header')@stop

@section('contenido')
    <script type="text/javascript">
        $(document).ready(function() {
            //$('textarea#cuerpo').ckeditor();
            CKEDITOR.replace( 'cuerpo', {
                    allowedContent: true,
                    fillEmptyBlocks: false
            } );
        });
    </script>

    <div>
        <h2>carga y modificación de html</h2>

        {{ Form::open(array('url' => 'admin/html/editar')) }}

            <input class="block anchoTotal marginBottom" type="text" name="titulo" placeholder="Título" value="{{$item->titulo}}">
            <div class="divEditorTxt">
                <textarea id="cuerpo" contenteditable="true" class="" name="cuerpo">{{ $html->cuerpo }}</textarea>
            </div>
            <div class="floatRight">
                <a onclick="cancelarPopup('agregar-seccion');" class="btnGris marginRight5">Cancelar</a>
                <input type="submit" value="Guardar" class="btn">
            </div>
            <div class="clear"></div>

            {{Form::hidden('html_id', $html->id)}}
            {{Form::hidden('id', $item->id)}}
        {{Form::close()}}
    </div>
@stop

@section('footer')@stop