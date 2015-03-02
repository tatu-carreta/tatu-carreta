@extends($project_name.'-master')

@section('footer_consulta_form')
<div class="clear"></div>
@stop

@section('contenido')
@if(count($item->imagenes_producto()) > 1)
<script type="text/javascript" charset="utf-8">
    $(window).load(function() {
        $('.slideProducto').flexslider({
            controlNav: false, //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
            directionNav: true
        });
    });
</script>
@endif
@if(Session::has('mensaje'))
<script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
@endif
<section>
    @if (Session::has('mensaje'))
        <div class="divAlerta ok alert-success">{{ Session::get('mensaje') }}<i onclick="" class="cerrarDivAlerta fa fa-times fa-lg"></i></div>
    @endif
    <div class="container">
        <h2><span class=""><a class="volveraSeccion" href="{{URL::to('/'.$item -> seccionItem() -> menuSeccion() -> url)}}">{{ $item -> seccionItem() -> menuSeccion() -> nombre }}</a></span></h2>
       
        @if(Auth::check())
            @if(Auth::user()->can("editar_item"))
            <a href="{{URL::to('admin/producto/editar/'.$item->producto()->id)}}" data='{{$item -> seccionItem() -> id}}' style="display:none">Editar<i class="fa fa-pencil fa-lg"></i></a>
            @endif
        @endif
        
        <!--columna producto y descripcion -->
        <div class="col70">
            <div class="imgProd">
                <div class="slideProducto">
                    <ul class="slides">
                        @if(count($item->imagenes_producto()) > 0)
                            @foreach($item->imagenes_producto() as $img)
                            <li>
                                <img src="{{ URL::to($img->carpeta.$img->nombre) }}" alt="{{$item->titulo}}">
                                <p>{{$img->epigrafe}}</p>
                            </li>
                            @endforeach
                        @else
                            <li><img src="{{ URL::to('images/sinImg.gif') }}" alt="{{$item->titulo}}"></li>
                        @endif
                    </ul>
                </div>
            </div>
            
            <div class="detalleProd">
                <h2>{{ $item -> titulo }}</h2> 
                <h2 class="marcaTit">Marca: @if(!is_null($item->producto()->marca_principal())){{ $item->producto()->marca_principal()->nombre }}@endif</h2>

                @if(!is_null($item->producto()->marca_principal()))
                    <img class="marcaPrincipal" src="@if(!is_null($item->producto()->marca_principal()->imagen())){{URL::to($item->producto()->marca_principal()->imagen()->carpeta.$item->producto()->marca_principal()->imagen()->nombre)}}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$item->producto()->marca_principal()->nombre}}">
                @endif

                @if($item->destacado())
                    <p class="precioTit">Precio: <span>${{ $item->producto()->precio(2) }}</span></p>
                @else
                    <p class="precioTit naranja">Precio: consulte</p>
                @endif

                @if($item->producto()->cuerpo != "")
                <div class="editor">
                    <h4>Detalles técnicos</h4>
                    {{ $item->producto()->cuerpo }}
                </div>
                @endif
                @if(count($item->producto()->marcas_secundarias()) > 0)
                        @foreach($item->producto()->marcas_secundarias() as $marca)
                            <img class="marcaSecundaria" src="@if(!is_null($marca->imagen())){{ URL::to($marca->imagen()->carpeta.$marca->imagen()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$marca->nombre}}">
                        @endforeach
                    @endif
                
                @if(count($item->archivos) > 0)
                    <h4 class="marginBottom05">Descargas PDF</h4>

                    @foreach($item->archivos as $archivo)
                    <a href="{{URL::to($archivo->carpeta.$archivo->nombre)}}" class="descargarPDF">{{$archivo->titulo}}</a>
                    @endforeach
                @endif
            </div>
            <div class="clear"></div>
        </div>
        <!--columna info Contacto -->
        <div class="col30">
            <div class="telHead">
                <span>Tiene dudas? Consúltenos:</span><br>
                <span class="num">(011) <strong>5197-0808</strong></span>
            </div>
            {{ Form::open(array('url' => 'admin/producto/producto-consulta', 'class' => 'formCol')) }}
                <h4>Consulte por este producto:</h4>
                <input type="text" name="nombre" placeholder="Nombre y Apellido">
                <input type="text" name="telefono" placeholder="Teléfono">
                <input type="email" name="email" placeholder="E-mail">
                <textarea name="mensaje" placeholder="Mensaje"></textarea>
                <input class="btnNaranja floatRight" type="submit" value="consultar">
                <div class="clear"></div>
                {{Form::hidden('producto_consulta_id', $item->producto()->id)}}
                {{Form::hidden('continue', 'detalle')}}
            {{Form::close()}}
        </div>
        <div class="clear"></div>
    </div>
</section>
@stop