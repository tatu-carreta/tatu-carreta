@extends($project_name.'-master')

@section('head')

    @parent

    <link rel="stylesheet" href="{{URL::to('css/ng-img-crop.css')}}" />
@stop

@section('contenido')
    @if (Session::has('mensaje'))
    <script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
    @endif
    <section class="container">
        {{ Form::open(array('url' => 'admin/portfolio_simple/editar', 'files' => true, 'role' => 'form')) }}
            <h2 class="marginBottom2"><span>Editar obra</span></h2>
            

            <div class="row marginBottom2">
                <!-- Abre columna de imágenes -->
                <div class="col-md-12 cargaImg">
                    <div class="fondoDestacado">

                    @if(Auth::user()->can('cambiar_seccion_item'))
                        <select name="seccion_nueva_id" class="form-control  marginBottom2">
                            <option value="">Seleccione Nueva Sección</option>
                            @foreach($secciones as $seccion)
                            <option value="{{$seccion->id}}" @if($seccion->id == $item->seccionItem()->id) selected @endif>@if($seccion->nombre != ""){{$seccion->nombre}}@else Sección {{$seccion->id}} - {{$seccion->menuSeccion()->nombre}}@endif</option>
                            @endforeach
                        </select>
                    @endif
            
                    <h3>Imagen principal</h3>
                    @if(!is_null($item->imagen_destacada()))
                        <div class="divCargaImgProducto" style="margin-bottom:0 !important">
                            <div class="marginBottom2 divCargaImg">
                                <img alt="{{$item->titulo}}"  src="{{ URL::to($item->imagen_destacada()->carpeta.$item->imagen_destacada()->nombre) }}">
                                <i onclick="borrarImagenReload('{{ URL::to('admin/imagen/borrar') }}', '{{$item->imagen_destacada()->id}}');" class="fa fa-times-circle fa-lg"></i>
                            </div>
                            <input type="hidden" name="imagen_portada_editar" value="{{$item->imagen_destacada()->id}}">
                            <input class="block marginBottom form-control" type="text" name="epigrafe_imagen_portada_editar" placeholder="Ingrese una descripción de la foto" value="{{ $item->imagen_destacada()->epigrafe }}">
                        </div>
                    @else
                        @include('imagen.modulo-imagen-angular-crop-horizontal')
                    @endif
                    </div>
                </div>
            </div>  
            

            <div class="punteado">
                <input type="submit" value="Publicar" class="btn btn-primary marginRight5">
                <a onclick="window.history.back();" class="btn btn-default">Cancelar</a>
            </div>


            {{Form::hidden('titulo', '')}}
            {{Form::hidden('continue', $continue)}}
            {{Form::hidden('id', $item->id)}}
            {{Form::hidden('portfolio_id', $portfolio->id)}}
        {{Form::close()}}
    </section>
@stop

@section('footer')

    @parent

    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js"></script>
    <script src="{{URL::to('js/angular-file-upload.js')}}"></script>
    <script src="{{URL::to('js/ng-img-crop.js')}}"></script>
    <script src="{{URL::to('js/controllers.js')}}"></script>

@stop
