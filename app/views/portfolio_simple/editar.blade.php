@extends($project_name.'-master')

@section('contenido')
    <section class="container">
        {{ Form::open(array('url' => 'admin/portfolio_simple/editar', 'files' => true, 'role' => 'form')) }}
            <h2><span>Editar obra</span></h2>
            <div class="marginBottom2">
                <a class="volveraSeccion" href="@if($seccion_next != 'null'){{URL::to('/'.Seccion::find($seccion_next) -> menuSeccion() -> url)}}@else{{URL::to('/')}}@endif"><i class="fa fa-caret-left"></i>Volver a @if($seccion_next != 'null'){{ Seccion::find($seccion_next) -> menuSeccion() -> nombre }}@else Home @endif</a>
            </div>
            

            <div class="row marginBottom2">
                <!-- Abre columna de imágenes -->
                <div class="col-md-12">
                    <div class="divCargaImgHoriz">

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
                <a href="@if($seccion_next != 'null'){{URL::to('/'.Seccion::find($seccion_next) -> menuSeccion() -> url)}}@else{{URL::to('/')}}@endif" class="btn btn-default">Cancelar</a>
            </div>


            {{Form::hidden('titulo', '')}}
            {{Form::hidden('continue', $continue)}}
            {{Form::hidden('id', $item->id)}}
            {{Form::hidden('portfolio_id', $portfolio->id)}}
            @if($seccion_next != 'null')
                {{Form::hidden('seccion_id', $seccion_next)}}
            @endif
        {{Form::close()}}
    </section>
@stop

@section('footer')

    @parent

    <script src="{{URL::to('js/angular-1.3.0.min.js')}}"></script>
    <script src="{{URL::to('js/angular-file-upload.js')}}"></script>
    <script src="{{URL::to('js/ng-img-crop.js')}}"></script>
    <script src="{{URL::to('js/controllers.js')}}"></script>

@stop
