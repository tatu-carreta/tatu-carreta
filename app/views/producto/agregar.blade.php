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
<section>
        {{ Form::open(array('url' => 'admin/producto/agregar', 'files' => true)) }}
            <h2 class="marginBottom2"><span>Carga y modificación de productos</span></h2>
            <div id="error" class="error" style="display:none"><span></span></div>
            <div id="correcto" class="correcto ok" style="display:none"><span></span></div>

            <!-- Abre columna de descripción -->
            <div class="col70Admin datosProducto">
                <h3>Nombre y modelo del producto</h3>
                <input class="block anchoTotal marginBottom" type="text" name="titulo" placeholder="Título" required="true" maxlength="50">

                <div class="divVerMarcaPrincipal marginBottom2">
                    <h3>Marca del producto</h3>
                    <select class="form-control selectMarca" name="marca_principal" id="marca_principal">
                        <option value="">Seleccione una Marca</option>
                        @foreach($marcas_principales as $marca)
                            <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                        @endforeach
                    </select>
                    <div class="marca_imagen_preview"></div>
                    <div class="clear"></div>
                    <p>Si la marca que busca no está en el listado anterior, deberá agregarla desde el <a href="{{URL::to('admin/marca')}}">administrador de marcas</a></p>
                    
                </div>

                <div class="fondoDestacado padding1 marginBottom2">
                    <div class="marginBottom1 class_checkbox">
                        <label for="destacarProducto" class="destacarProducto noTocado">
                            <input id="destacarProducto" class="precioDisabled check_box" type="checkbox" name="item_destacado" value="A">
                            <span class="spanDestacarProd">Destacar este producto</span>
                        </label>
                    </div>

                    <p>Los últimos 5 productos destacados se muestran en la home.<br>
                        Los productos destacados deben tener precio</p>

                    <div class="form-group">
                        <label for="precio">Precio</label><span>$</span>
                        <input type="text" name="precio" disabled="true" class="precioAble">
                    </div>

                    
                </div>

                <h3>Detalles técnicos</h3>
                <div class="divEditorTxt marginBottom2">
                    <textarea id="texto" contenteditable="true" name="cuerpo"></textarea>
                </div>

                 <div class="marginBottom2">
                    <h3>Marcas Técnicas</h3>
                    
                    @foreach($marcas_secundarias as $marca)
                    <div class="boxMarcaTecnica">
                        <input type="checkbox" name="marcas_secundarias[]" value="{{$marca->id}}" id="{{$marca->nombre}}{{$marca->id}}">
                        <label for="{{$marca->nombre}}{{$marca->id}}"><span>{{$marca->nombre}}</span> <img style="width: 50px; height: 50px;" class="lazy" data-original="@if(!is_null($marca->imagen())){{ URL::to($marca->imagen()->carpeta.$marca->imagen()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$marca->nombre}}"></label>
                    </div>
                    @endforeach
                </div>

                <h3>Archivos PDF</h3>
                <div  class="marginBottom2">
                    @include('archivo.modulo-archivo-maxi')
                </div>
            </div>

            <!-- Abre columna de imágenes -->
            <div class="col30Admin fondoDestacado padding1 cargaImg">
                <h3>Imagen principal</h3>
                @include('imagen.modulo-imagen-euge')
                @include('imagen.modulo-galeria-producto-maxi')
            </div>

            <div class="clear"></div>
            <!-- cierran columnas -->
            
            

            <div class="punteado">
                <input type="submit" value="Publicar" class="btn marginRight5">
                <a onclick="window.history.back();" class="btnGris">Cancelar</a>
            </div>


            {{Form::hidden('seccion_id', $seccion_id)}}
            {{Form::hidden('descripcion', '')}}
            {{Form::hidden('tipo_precio_id[]', '2')}}
        {{Form::close()}}
    </section>
@stop
