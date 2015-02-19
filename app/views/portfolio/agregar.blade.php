@extends($project_name.'-master')

@section('contenido')
    @if (Session::has('mensaje'))
    <script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
    @endif
    <script src="{{URL::to('js/ckeditorLimitado.js')}}"></script>
    
    <section class="container">
        @if (Session::has('mensaje'))
            <div class="divAlerta error alert-success">{{ Session::get('mensaje') }}<i onclick="" class="cerrarDivAlerta fa fa-times fa-lg"></i></div>
        @endif
        {{ Form::open(array('url' => 'admin/portfolio/agregar', 'files' => true)) }}
            <h2 class="marginBottom2"><span>Carga y modificación de portfolio</span></h2>
            <div id="error" class="error" style="display:none"><span></span></div>
            <div id="correcto" class="correcto ok" style="display:none"><span></span></div>

            <!-- Abre columna de imágenes -->
            <div class="col30 fondoDestacado padding1 cargaImg">
                <h3>Imagen principal</h3>
                @include('imagen.modulo-imagen-general-maxi')
            </div>

            <div class="clear"></div>
            <!-- cierran columnas -->
            
            <div class="punteado">
                <input type="submit" value="Publicar" class="btn marginRight5">
                <a onclick="window.history.back();" class="btnGris">Cancelar</a>
            </div>

            {{Form::hidden('titulo', $seccion_id)}}
            {{Form::hidden('seccion_id', $seccion_id)}}
        {{Form::close()}}
    </section>
@stop
