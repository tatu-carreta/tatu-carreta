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
        {{ Form::open(array('url' => 'admin/portfolio/editar', 'files' => true)) }}
            <h2 class="marginBottom2"><span>Carga y modificación de portfolio</span></h2>

        @if(Auth::user()->can('cambiar_seccion_item'))
            <select name="seccion_nueva_id">
                <option value="">Seleccione Nueva Sección</option>
                @foreach($secciones as $seccion)
                <option value="{{$seccion->id}}" @if($seccion->id == $item->seccionItem()->id) selected @endif>@if($seccion->nombre != ""){{$seccion->nombre}}@else Sección {{$seccion->id}} - {{$seccion->menuSeccion()->nombre}}@endif</option>
                @endforeach
            </select>
        @endif
            <!-- Columna 60% imágenes-->
            <div class="col30 fondoDestacado padding1 cargaImg">
                <h3>Imagen principal</h3>
                @if(!is_null($item->imagen_destacada()))
                    <div class="divCargaImgProducto">
                        <div class="marginBottom1 divCargaImg">
                            <img alt="{{$item->titulo}}"  src="{{ URL::to($item->imagen_destacada()->carpeta.$item->imagen_destacada()->nombre) }}">
                            <i onclick="borrarImagenReload('{{ URL::to('admin/imagen/borrar') }}', '{{$item->imagen_destacada()->id}}');" class="fa fa-times fa-lg"></i>
                        </div>
                        <input type="hidden" name="imagen_portada_editar" value="{{$item->imagen_destacada()->id}}">
                        <input class="block anchoTotal marginBottom" type="text" name="epigrafe_imagen_portada_editar" placeholder="Ingrese una descripción de la foto" value="{{ $item->imagen_destacada()->epigrafe }}">
                    </div>
                @else
                    @include('imagen.modulo-imagen-general-maxi')
                @endif
                <div class="clear"></div>
            </div>
            <!-- fin Columna imágenes-->

            <div class="clear"></div>

            <div class="punteado">
                <input type="submit" value="Guardar" class="btn marginRight5">
                <a onclick="window.history.back();" class="btnGris">Cancelar</a>
            </div>

            {{Form::hidden('titulo', "")}}
            {{Form::hidden('continue', $continue)}}
            {{Form::hidden('id', $item->id)}}
            {{Form::hidden('portfolio_id', $portfolio->id)}}
        {{Form::close()}}
    </section>
@stop
