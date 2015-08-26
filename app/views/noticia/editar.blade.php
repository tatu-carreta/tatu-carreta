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
        {{ Form::open(array('url' => 'admin/noticia/editar', 'files' => true)) }}
            <h2 class="marginBottom2"><span>Carga y modificación de noticias</span></h2>
{{--
        @if(Auth::user()->can('cambiar_seccion_item'))
            <select name="seccion_nueva_id">
                <option value="">Seleccione Nueva Sección</option>
                @foreach($secciones as $seccion)
                <option value="{{$seccion->id}}" @if($seccion->id == $item->seccionItem()->id) selected @endif>@if($seccion->nombre != ""){{$seccion->nombre}}@else Sección {{$seccion->id}} - {{$seccion->menuSeccion()->nombre}}@endif</option>
                @endforeach
            </select>
        @endif
--}}
            <!-- abre datos del Producto-->
            <div class="col70Admin datosProducto">
                <h3>Título de la noticia</h3>
                <input class="block anchoTotal marginBottom" type="text" name="titulo" placeholder="Título" required="true" value="{{ $item->titulo }}" maxlength="100">
                
                <h3>Fecha</h3>
                <input class="block anchoTotal marginBottom" type="date" name="fecha" placeholder="Fecha" required="true" value="{{ $noticia->fecha }}" maxlength="50">
                
                <h3>Fuente</h3>
                <input class="block anchoTotal marginBottom" type="text" name="fuente" placeholder="Fuente" required="true" value="{{ $noticia->fuente }}" maxlength="50">

                <h3>Descripción</h3>
                <input class="block anchoTotal marginBottom" type="text" name="descripcion" placeholder="Descripción" required="true" value="{{ $item->descripcion }}" maxlength="200">
                
                <h3>Cuerpo</h3>
                <div class="divEditorTxt marginBottom2">
                    <textarea id="texto" contenteditable="true" class="" name="cuerpo">{{ $item->texto()->cuerpo }}</textarea>
                </div>

            </div>
            
            <h3>Secciones</h3>
            @foreach($secciones as $s)
                @if($s->menuSeccion()->modulo()->nombre == $item->seccionItem()->menuSeccion()->modulo()->nombre)
                    @if(count($s->menuSeccion()->children) == 0)
                        <h5>{{$s->menuSeccion()->nombre}}</h5>

                        @foreach($s->menuSeccion()->secciones as $seccion)
                            <input type="checkbox" name="secciones[]" value="{{$seccion->id}}" @if(in_array($seccion->id, $item->secciones->lists('id'))) checked="true" @endif>@if($seccion->titulo != ""){{$seccion->titulo}}@else Sección {{$seccion->id}} @endif
                    @endforeach
                @endif
                @endif
            @endforeach
            
            <!-- Cierra columna ancha -->


            <!-- Columna 60% imágenes-->
            <div class="col30Admin fondoDestacado padding1 cargaImg">
                <h3>Imagen principal</h3>
                @if(!is_null($item->imagen_destacada()))
                    <div class="divCargaImgProducto">
                        <div class="marginBottom1 divCargaImg">
                            <img alt="{{$item->titulo}}"  src="{{ URL::to($item->imagen_destacada()->ampliada()->carpeta.$item->imagen_destacada()->ampliada()->nombre) }}">
                            <i onclick="borrarImagenReload('{{ URL::to('admin/imagen/borrar') }}', '{{$item->imagen_destacada()->id}}');" class="fa fa-times fa-lg"></i>
                        </div>
                        <input type="hidden" name="imagen_portada_editar" value="{{$item->imagen_destacada()->id}}">
                        <input class="block anchoTotal marginBottom" type="text" name="epigrafe_imagen_portada_editar" placeholder="Ingrese una descripción de la foto" value="{{ $item->imagen_destacada()->ampliada()->epigrafe }}">
                    </div>
                @else
                    @include('imagen.modulo-imagen-noticia-maxi')
                @endif
                <div class="clear"></div>
            </div>
            <!-- fin Columna imágenes-->

            <div class="clear"></div>

            <div class="punteado">
                <input type="submit" value="Guardar" class="btn marginRight5">
                <a onclick="window.history.back();" class="btnGris">Cancelar</a>
            </div>

            {{Form::hidden('continue', $continue)}}
            {{Form::hidden('id', $item->id)}}
            {{Form::hidden('noticia_id', $noticia->id)}}
        {{Form::close()}}
    </section>
@stop
