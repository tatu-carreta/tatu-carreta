@extends($project_name.'-master')

@section('contenido')
<style>
    .check_box {
    display:none;
}

.noTocado{
    background:url('{{URL::to("images/destacadoAzul.png")}}') no-repeat;
    height: 30px;
    width: 30px;
    display: inline-block;
    padding: 0 0 0 2em;
}

.tocado{
    background:url('{{URL::to("images/destacadoRojo.png")}}') no-repeat;
    height: 30px;
    width: 30px;
    display: inline-block;
    padding: 0 0 0 2em;
}

</style>
<script src="{{URL::to('js/ckeditorLimitado.js')}}"></script>
<script src="{{URL::to('js/producto-funcs.js')}}"></script>
    <section class="container">    
        {{ Form::open(array('url' => 'admin/producto/agregar', 'files' => true, 'role' => 'form', 'onsubmit' => 'return validatePrecioProd(this);')) }}
        <h2><span>Nuevo producto</span></h2>
        <div class="marginBottom2">
            <a class="volveraSeccion" href="{{URL::to('/'.Seccion::find($seccion_id) -> menuSeccion() -> url)}}"><i class="fa fa-caret-left"></i>Volver a {{ Seccion::find($seccion_id) -> menuSeccion() -> nombre }}</a>
        </div>
        <div class="row datosProducto">
            <!-- Abre columna de descripción de Producto -->
            <div class="col-md-6">

                <!-- Nombre del producto -->
                <div>
                    <h3>Código del producto</h3>
                    <div class="form-group marginBottom2">
                        <input class="form-control" type="text" name="titulo" placeholder="Código" required="true" maxlength="9">
                        <p class="infoTxt"><i class="fa fa-info-circle"></i>No puede haber dos productos con igual código. Máximo 9 caracteres.</p>
                </div>
            </div>

                <!-- Estado  -->
                <h3>Estado</h3>
                <div class="marginBottom2">
                    <!--
                    <div class="fondoDestacado marginBottom05">
                        <div class="radio">
                            <label>
                                <input id="" class="" type="checkbox" name="item_destacado" value="B" checked="true">
                                Normal
                            </label>
                        </div>
                    </div>
                    -->
                    <div class="fondoDestacado marginBottom05">
                        <div class="radio">
                            <label>
                                <input id="" class="" type="checkbox" name="item_destacado" value="N">
                                <i class="fa fa-tag prodDestacado fa-lg"></i>
                                Nuevo
                            </label>
                        </div>
                    </div>
                    <div class="fondoDestacado marginBottom05">
                        <div class="divEstado">
                            <div class="estado">
                                <div class="radio">
                                    <label>
                                        
                                        <input id="" class=" precioDisabled" type="checkbox" name="item_destacado" value="O">
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
                    </div>
                    <p class="infoTxt"><i class="fa fa-info-circle"></i>Los productos NUEVOS y las OFERTAS se muestran también en la home.</p>
                </div>
                
                <h3>Ubicación</h3>
                <div class="fondoDestacado modIndicarSeccion">
                    
                        @foreach($menues as $men)
                        <div class="cadaSeccion">
                            @if(count($men->children) == 0)
                                <div>
                                    @foreach($men->secciones as $seccion)
                                        <span><input id="menu{{$men->id}}" type="checkbox" name="secciones[]" value="{{$seccion->id}}" @if($seccion->id == $seccion_id) checked="true" disabled @endif>{{-- @if($seccion->titulo != ""){{$seccion->titulo}}@else Sección {{$seccion->id}} @endif --}}</span>
                                    @endforeach
                                </div>
                                <div><label for="menu{{$men->id}}">{{$men->nombre}}</label></div>
                            @endif
                        </div>
                        @endforeach
                </div>
            </div><!--cierra columna datos de producto-->

            <!-- Abre columna de imágenes -->
            <h3>Imagen del producto</h3>
            <div class="col-md-6 fondoDestacado cargaImg">
                <h3>Carga y recorte de la imagen</h3>

                @include('imagen.modulo-imagen-angular-crop')

            </div>

            <div class="clear"></div>
            <!-- cierran columnas -->


        </div>  
            

            <div class="border-top">
                <input type="submit" value="Publicar" class="btn btn-primary marginRight5">
                <a href="{{URL::to('/'.Seccion::find($seccion_id) -> menuSeccion() -> url)}}" class="btn btn-default">Cancelar</a>
            </div>


            {{Form::hidden('seccion_id', $seccion_id)}}
            {{Form::hidden('descripcion', '')}}
            {{Form::hidden('tipo_precio_id[]', '2')}}
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