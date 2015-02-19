@extends($project_name.'-master')

@section('head')@stop
@section('header')@stop

@section('contenido')
    <script>
        $(document).ready(function() {
            //$('textarea#cuerpo').ckeditor();
            CKEDITOR.replace( 'html', {
                    allowedContent: true,
                    fillEmptyBlocks: false
            } );
        });
    </script>

    <div>
        <h2>carga y modificación de html</h2>

        {{ Form::open(array('url' => 'admin/html/agregar')) }}

            <input class="block anchoTotal marginBottom" type="text" name="titulo" placeholder="Título">
            <div class="divEditorTxt">
                <textarea id="html" contenteditable="true" class="" name="cuerpo"></textarea>
            </div>
            <div class="floatRight">
                <a onclick="cancelarPopup('agregar-seccion');" class="btnGris marginRight5">Cancelar</a>
                <input type="submit" value="Guardar" class="btn">
            </div>

            <div class="clear"></div>

            {{Form::hidden('seccion_id', $seccion_id)}}
        {{Form::close()}}
    </div>
@stop

@section('footer')@stop