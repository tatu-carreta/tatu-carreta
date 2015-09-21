@extends($project_name.'-master')

@section('contenido')
<script src="{{URL::to('js/ckeditorLimitado.js')}}"></script>
<script src="{{URL::to('js/producto-funcs.js')}}"></script>
<section class="container"  id="ng-app" ng-app="app">    
    <div ng-controller="ImagenMultiple" nv-file-drop="" uploader="uploader" filters="customFilter, sizeLimit">
    {{ Form::open(array('url' => 'admin/producto/editar', 'files' => true, 'role' => 'form', 'onsubmit' => 'return validatePrecioProd(this);')) }}
        <h2><span>Editar producto</span></h2>
        <div class="marginBottom2">
            <a class="volveraSeccion" href="@if($seccion_next != 'null'){{URL::to('/'.Seccion::find($seccion_next) -> menuSeccion() -> url)}}@else{{URL::to('/')}}@endif"><i class="fa fa-caret-left"></i>Volver a @if($seccion_next != 'null'){{ Seccion::find($seccion_next) -> menuSeccion() -> nombre }}@else Home @endif</a>
        </div>

        <h3>Código del producto</h3>
        <div class="form-group">
            <input class="form-control" type="text" name="titulo" placeholder="Código" required="true" maxlength="9" value="{{ $item->titulo }}">
            <p class="infoTxt"><i class="fa fa-info-circle"></i>No puede haber dos productos con igual código. Máximo 9 caracteres.</p>
        </div>

        <div class="row marginBottom2">
            <!-- Abre columna de imágenes -->
            <div class="col-md-12 cargaImg">
                    <div class="fondoDestacado">
                        <h3>Recorte de imágenes</h3>
                        <input type="hidden" ng-model="url_public" ng-init="url_public = '{{URL::to('/')}}'">
                        @include('imagen.modulo-imagen-angular-crop-horizontal-multiples')
                    <div class="row">
                        @if((count($item->imagen_destacada()) > 0) || (count($item->imagenes) > 0))
                            <div class="col-md-12">
                                <h3>Imágenes cargadas</h3>
                            </div>
                        @endif
                        @if(count($item->imagen_destacada()) > 0)
                        <div class="imgSeleccionadas">
                            <div class="col-md-3">
                                <div class="thumbnail">
                                    <input type="hidden" name="imagen_crop_editar[]" value="{{$item->imagen_destacada()->id}}">
                                    <img class="marginBottom1" src="{{ URL::to($item->imagen_destacada()->carpeta.$item->imagen_destacada()->nombre) }}" alt="{{$item->titulo}}">
                                    <input class="form-control" type="text" name="epigrafe_imagen_crop_editar[]" value="{{$item->imagen_destacada()->epigrafe}}">
                                    <i onclick="borrarImagenReload('{{ URL::to('admin/imagen/borrar') }}', '{{$item->imagen_destacada()->id}}');" class="fa fa-times-circle fa-lg"></i>
                                </div>
                            </div>
                        </div>
                        @endif
                        @foreach($item->imagenes as $img)
                         <div class="imgSeleccionadas">
                            <div class="col-md-3">
                                <div class="thumbnail">
                                    <input type="hidden" name="imagen_crop_editar[]" value="{{$img->id}}">
                                    <img class="marginBottom1" src="{{ URL::to($img->carpeta.$img->nombre) }}" alt="{{$item->titulo}}">
                                    <input class="form-control" type="text" name="epigrafe_imagen_crop_editar[]" value="{{$img->epigrafe}}">
                                    <i onclick="borrarImagenReload('{{ URL::to('admin/imagen/borrar') }}', '{{$img->id}}');" class="fa fa-times-circle fa-lg"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div ng-repeat="img in imagenes_seleccionadas" class="imgSeleccionadas">
                            <div class="col-md-3">
                                <div class="thumbnail">
                                    <input type="hidden" name="imagen_portada_ampliada[]" value="<% img.imagen_portada_ampliada %>">
                                    <img class="marginBottom1" ng-src="<% img.src %>">
                                    <input type="hidden" name="epigrafe_imagen_portada[]" value="<% img.epigrafe %>">
                                    <input type="hidden" name="imagen_portada_crop[]" value="<% img.imagen_portada %>">
                                    <i ng-click="borrarImagenCompleto($index)" class="fa fa-times-circle fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

        <div class="row">
            <div class="col-md-6">
                <!-- Estado  -->
                <div class="divEstado">
                <h3>Estado</h3>
                    <div class="divEstadoNuevo">
                        <div class="radio">
                            <label>
                                <input id="" class="" type="checkbox" name="item_destacado" value="N" @if($item->producto()->nuevo()) checked="true" @endif>
                                 <i class="fa fa-tag prodDestacado fa-lg"></i>
                                Nuevo
                            </label>
                        </div>
                    </div>
                    <div class="divEstadoOferta">
                        <div class="checkEstado">
                            <div class="radio">
                                <label>
                                    <input id="" class="precioDisabled" type="checkbox" name="item_destacado" value="O" @if($item->producto()->oferta()) checked="true" @endif>
                                    <i  class="fa fa-usd prodDestacado fa-lg"></i>
                                    Oferta
                                </label>
                            </div>
                        </div>
                        <div class="divPrecio">
                            <label for="" >
                                <span>Precio después $ </span><input id="" class="form-control inputWidth60 precioAble1 precio-number" type="text" name="precio_antes" value="">
                            </label>
                        </div>
                        <div class="divPrecio">
                            <label for="" >
                                <span>Precio antes $ </span><input id="" class="form-control inputWidth60 precioAble1 precio-number" type="text" name="precio_actual" value="">
                            </label>
                        </div>   
                        <div class="clearfix"></div>
                    </div>
                    <p class="infoTxt"><i class="fa fa-info-circle"></i>Los productos NUEVOS y las OFERTAS se muestran también en la home.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Texto descriptivo de la obra</h3>
                <div class="divEditorTxt marginBottom2">
                    <textarea id="texto" contenteditable="true" name="cuerpo">{{ $item->producto()->cuerpo }}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h3>Videos</h3>
            </div>
        </div>
        <div class="row">
            @foreach($item->videos as $video)
                <div class="col-md-4 marginBottom2">
                    <iframe class="video-tc" src="@if($video->tipo == 'youtube')https://www.youtube.com/embed/@else//player.vimeo.com/video/@endif{{ $video->url }}"></iframe>
                    <a onclick="borrarVideoReload('{{ URL::to('admin/video/borrar') }}', '{{$video->id}}');" class="btn pull-right"><i class="fa fa-times fa-lg"></i>eliminar</a>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-6">
                @if(count($item->videos) == 2)
                    <div class="form-group marginBottom2">
                        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                    </div>
                @elseif(count($item->videos) == 1)
                    <div class="form-group marginBottom2">
                        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                    </div>
                    <div class="form-group marginBottom2">
                        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                    </div>
                @elseif(count($item->videos) == 0)
                    <div class="form-group marginBottom2">
                        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                    </div>
                    <div class="form-group marginBottom2">
                        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                    </div>
                    <div class="form-group marginBottom2">
                        <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Indicar Sección a la que pertenece el producto  -->
                <div class="divModIndicarSeccion">
                    @if($seccion_next != 'null')
                    <h3>Ubicación</h3>
                        <div class="modIndicarSeccion">
                                @foreach($menues as $men)
                                <div class="cadaSeccion">
                                    @if(count($men->children) == 0)
                                        <div>
                                            @foreach($men->secciones as $seccion)
                                                <span><input id="menu{{$men->id}}" type="checkbox" name="secciones[]" value="{{$seccion->id}}" @if(in_array($seccion->id, $item->secciones->lists('id'))) checked="true" @endif @if($seccion->id == $seccion_next) disabled @endif>{{-- @if($seccion->titulo != ""){{$seccion->titulo}}@else Sección {{$seccion->id}} @endif --}}</span>
                                            @endforeach
                                        </div>
                                        <div><label for="menu{{$men->id}}">{{$men->nombre}}</label></div>
                                    @endif
                                </div>
                                @endforeach
                        </div>
                    @else

                    @foreach($item->secciones as $seccion)
                        <input type="hidden" name="secciones[]" value="{{$seccion->id}}">
                    @endforeach
                @endif

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="border-top">
                    <input type="submit" value="Publicar" class="btn btn-primary marginRight5">
                    <a href="@if($seccion_next != 'null'){{URL::to('/'.Seccion::find($seccion_next) -> menuSeccion() -> url)}}@else{{URL::to('/')}}@endif" class="btn btn-default">Cancelar</a>
                </div>
            </div>
        </div>


        {{Form::hidden('continue', $continue)}}
        {{Form::hidden('id', $item->id)}}
        {{Form::hidden('producto_id', $producto->id)}}
        {{Form::hidden('descripcion', '')}}
        {{Form::hidden('tipo_precio_id[]', '2')}}
        @if($seccion_next != 'null')
            {{Form::hidden('seccion_id', $seccion_next)}}
        @endif
    {{Form::close()}}
    </div>
</section>
@stop

@section('footer')

    @parent

    <script src="{{URL::to('js/angular-1.3.0.min.js')}}"></script>
    <script src="{{URL::to('js/angular-file-upload.js')}}"></script>
    <script src="{{URL::to('js/ng-img-crop.js')}}"></script>
    <script src="{{URL::to('js/controllers.js')}}"></script>

@stop
