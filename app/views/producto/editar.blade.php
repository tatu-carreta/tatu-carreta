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
    @if (Session::has('mensaje'))
    <script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
    @endif
    <script src="{{URL::to('js/ckeditorLimitado.js')}}"></script>
    <script>
        $(document).ready(function(){
            if($('.precioDisabled').attr('checked'))
            {
                $('.precioAble').removeAttr('disabled');
                $('.precioAble').attr('required','true');
            }
            $(".imagenEditarNone").removeAttr('required');
            $(".destacadoEditarNone").removeAttr('checked');
        });
        $(function(){
            console.log($('.class_checkbox').click(function(e){
                e.preventDefault();
                if (!$('.precioDisabled').attr('checked'))
                {
                    $(this).children(":first").addClass('tocado');
                    $(this).children(":first").removeClass('noTocado');
                    $('.precioAble').removeAttr('disabled');
                    $('.precioAble').attr('required','true');
                    $('.precioDisabled').attr('checked', 'true');
                    $('.precioAble').focus();
                }
                else
                {
                    $(this).children(":first").addClass('noTocado');
                    $(this).children(":first").removeClass('tocado');
                    $('.precioAble').attr('disabled','disabled');
                    $('.precioAble').removeAttr('required');
                    $('.precioDisabled').removeAttr('checked');
                    $('.precioAble').focusout();
                }
            }));
            
            
            
            $(".selectMarca").change(function(){
                var id = $(".selectMarca option:selected").val();
                if(id != "")
                {
                    console.log($.post("{{URL::to('admin/marca/imagen')}}", {'marca_id': id}, function(data) {
                        $(".marca_imagen_preview").html(data);
                    }));
                }
                else
                {
                    $(".marca_imagen_preview").html("");
                }
            });
        });
    </script>
    <section class="container">
        @if (Session::has('mensaje'))
            <div class="divAlerta error alert-success">{{ Session::get('mensaje') }}<i onclick="" class="cerrarDivAlerta fa fa-times fa-lg"></i></div>
        @endif
        {{ Form::open(array('url' => 'admin/producto/editar', 'files' => true)) }}
            <h2 class="marginBottom2"><span>Carga y modificación de productos</span></h2>

            <!-- abre datos del Producto-->
            <div class="col70Admin datosProducto">
                <h3>Nombre y modelo del producto</h3>
                <input class="block anchoTotal marginBottom" type="text" name="titulo" placeholder="Título" required="true" value="{{ $item->titulo }}" maxlength="50">
                <div class="divVerMarcaPrincipal marginBottom2">
                    <h3>Marca del producto</h3>
                    <select class="form-control selectMarca" name="marca_principal">
                        <option value="">Seleccione una Marca</option>
                        @foreach($marcas_principales as $marca)
                            <option value="{{$marca->id}}" @if(!is_null($producto->marca_principal())) @if($marca->id == $producto->marca_principal()->id) selected @endif @endif>{{$marca->nombre}}</option>
                        @endforeach
                    </select>
                    <div class="marca_imagen_preview">
                        @if(!is_null($producto->marca_principal()))
                            @if(!is_null($producto->marca_principal()->imagen()))
                                <img src="{{ URL::to($producto->marca_principal()->imagen()->carpeta.$producto->marca_principal()->imagen()->nombre) }}" alt="{{$producto->marca_principal()->nombre}}">
                            @endif
                        @endif
                    </div>
                    <div class="clear"></div>
                    <p>Si la marca que busca no está en el listado anterior, deberá agregarla desde el <a href="{{URL::to('admin/marca')}}">administrador de marcas</a></p>
                </div>

                <div class="fondoDestacado padding1 marginBottom2">
                    <div class="marginBottom1 class_checkbox">
                        <label for="destacarProducto" class="destacarProducto @if($item->destacado()) tocado @else noTocado @endif">
                            <input id="destacarProducto" class="precioDisabled check_box" type="checkbox" name="item_destacado" value="A" @if($item->destacado())checked="true"@endif>
                            <span class="spanDestacarProd">Destacar este producto</span>
                        </label>
                    </div>
                    <p>Los últimos 5 productos destacados se muestran en la home.<br>
                        Los productos destacados deben tener precio</p>

                    <div class="form-group">
                        <label for="precio">Precio</label><span>$</span>
                        <input type="text" name="precio" placeholder="Precio" disabled="true" class="precioAble" value="@if($item->destacado()){{ $producto->precio(2) }}@endif">
                    </div>

                </div>

                <h3>Detalles técnicos</h3>
                <div class="divEditorTxt marginBottom2">
                    <textarea id="texto" contenteditable="true" class="" name="cuerpo">{{ $producto->cuerpo }}</textarea>
                </div>

                <div class="marginBottom2">
                    <h3>Marcas Técnicas</h3>
                        @foreach($marcas_secundarias as $marca)
                        <div class="boxMarcaTecnica">
                            <input type="checkbox" name="marcas_secundarias[]" value="{{$marca->id}}" id="{{$marca->nombre}}{{$marca->id}}" @if(in_array($marca->id, $producto->marcas_secundarias_editar()))checked="true"@endif><label for="{{$marca->nombre}}{{$marca->id}}"><span>{{$marca->nombre}}</span> <img style="width: 50px; height: 50px;" class="lazy" data-original="@if(!is_null($marca->imagen())){{ URL::to($marca->imagen()->carpeta.$marca->imagen()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$marca->nombre}}"></label>
                        </div>
                    @endforeach
                </div>

                <h3>Archivos PDF</h3>
                <div  class="marginBottom2">
                    <div class="">
                        @if(count($item->archivos) > 0)
                            @foreach($item->archivos as $archivo)
                            <div class="archivoCargado">
                                <a class="descargarPDF">{{$archivo->titulo}}</a>
                                <i onclick="borrarImagenReload('{{ URL::to('admin/archivo/borrar') }}', '{{$archivo->id}}');" class="fa fa-times fa-lg"></i>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    @include('archivo.modulo-archivo-maxi')
                </div>

            </div>
            <!-- Cierra columna ancha -->


            <!-- Columna 60% imágenes-->
            <div class="col30 fondoDestacado padding1 cargaImg">
                <h3>Imagen principal</h3>
                @if(!is_null($item->imagen_destacada()))
                    <div class="divCargaImgProducto">
                        <div class="marginBottom1 divCargaImg">
                            <img alt="{{$item->titulo}}"  src="{{ URL::to($item->imagen_destacada()->carpeta.$item->imagen_destacada()->nombre) }}">
                            <i onclick="borrarImagenReload('{{ URL::to('admin/imagen/borrar') }}', '{{$item->imagen_destacada()->id}}');" class="fa fa-times fa-lg"></i>
                        </div>
                        <input type="hidden" name="imagen_producto_editar" value="{{$item->imagen_destacada()->id}}">
                        <input class="block anchoTotal marginBottom" type="text" name="epigrafe_imagen_producto_editar" placeholder="Ingrese una descripción de la foto" value="{{ $item->imagen_destacada()->epigrafe }}">
                    </div>
                @else
                    @include('imagen.modulo-imagen-producto-maxi')
                @endif

                <h3>Imágenes secundarias</h3>
                @if(count($item->imagenes_producto_editar()) > 0)
                    <div class="divCargaImgProducto">
                        @foreach($item->imagenes_producto_editar() as $img)
                        <div class="marginBottom1 divCargaImg">
                            <img 
                            src="{{ URL::to($img->carpeta.$img->nombre) }}" alt="{{$item->titulo}}">
                            <i onclick="borrarImagenReload('{{URL::to('admin/imagen/borrar')}}', '{{$img->id}}');" class="fa fa-times fa-lg"></i>
                        </div>
                        <input type="hidden" name="imagenes_editar[]" value="{{$img->id}}">
                        <input class="block anchoTotal marginBottom" type="text" name="epigrafe_imagen_editar[]" placeholder="Ingrese una descripción de la foto" value="{{ $img->epigrafe }}">
                        @endforeach
                    </div>
                @endif
                @include('imagen.modulo-galeria-producto-maxi')
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
            {{Form::hidden('producto_id', $producto->id)}}
            {{Form::hidden('descripcion', '')}}
            {{Form::hidden('tipo_precio_id[]', '2')}}
        {{Form::close()}}
    </section>
@stop
