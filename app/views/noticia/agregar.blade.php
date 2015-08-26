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
        {{ Form::open(array('url' => 'admin/noticia/agregar', 'files' => true)) }}
            <h2 class="marginBottom2"><span>Carga y modificación de noticias</span></h2>
            <div id="error" class="error" style="display:none"><span></span></div>
            <div id="correcto" class="correcto ok" style="display:none"><span></span></div>

            <!-- Abre columna de descripción -->
            <div class="col70Admin datosProducto">
                <h3>Título de la noticia</h3>
                <input class="block anchoTotal marginBottom" type="text" name="titulo" placeholder="Título" required="true" maxlength="100">

                <h3>Fecha</h3>
                <input class="block anchoTotal marginBottom" type="text" name="fecha" placeholder="Fecha" required="true" maxlength="50">
                
                <h3>Fuente</h3>
                <input class="block anchoTotal marginBottom" type="text" name="fuente" placeholder="Fuente" required="true" maxlength="50">

                <h3>Descripción</h3>
                <input class="block anchoTotal marginBottom" type="text" name="descripcion" placeholder="Descripción" required="true" maxlength="200">

                <h3>Cuerpo</h3>
                <div class="divEditorTxt marginBottom2">
                    <textarea id="texto" contenteditable="true" name="cuerpo"></textarea>
                </div>
                
                <h3>Secciones</h3>
                @foreach($secciones as $s)
                    @if($s->menuSeccion()->modulo()->nombre == $seccion->menuSeccion()->modulo()->nombre)
                        @if(count($s->menuSeccion()->children) == 0)
                            <h5>{{$s->menuSeccion()->nombre}}</h5>
                        
                            @foreach($s->menuSeccion()->secciones as $seccion)
                                <input type="checkbox" name="secciones[]" value="{{$seccion->id}}" @if($seccion->id == $seccion_id) checked="true" disabled @endif>@if($seccion->titulo != ""){{$seccion->titulo}}@else Sección {{$seccion->id}} @endif
                            @endforeach
                        @endif
                    @endif
                @endforeach
                
            </div>

            <!-- Abre columna de imágenes -->
            <div class="col30Admin fondoDestacado padding1 cargaImg">
                <h3>Imagen principal</h3>
                @include('imagen.modulo-imagen-noticia-maxi')
            </div>

            <div class="clear"></div>
            <!-- cierran columnas -->
            
            

            <div class="punteado">
                <input type="submit" value="Publicar" class="btn marginRight5">
                <a onclick="window.history.back();" class="btnGris">Cancelar</a>
            </div>


            {{Form::hidden('seccion_id', $seccion_id)}}
        {{Form::close()}}
    </section>
@stop
