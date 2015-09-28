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
<section class="container">
    <div class="row">
        <div class="col-md-12 marginBottom2">
            <h2>{{ $item -> seccionItem() -> titulo }}</h2>
            <a class="volveraSeccion" href="{{URL::to('/'.$item -> seccionItem() -> menuSeccion() -> url)}}"><i class="fa fa-caret-left"></i>Volver a {{ $item -> seccionItem() -> menuSeccion() -> nombre }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            @if(!is_null($item->imagen_destacada()))
            <div class="row">
                <div class="col-md-12">
                    <div class="divImgItem">
                        <img class="lazy" src="{{URL::to($item->imagen_destacada()->ampliada()->carpeta.$item->imagen_destacada()->ampliada()->nombre)}}">
                    </div>
                </div>
            </div>
            
            @endif
            @if(count($item->imagenes_producto_editar()) > 0)
            <div class="row">
                @foreach($item->imagenes_producto_editar() as $img)
                <div class="col-md-6">
                    <img src="{{ URL::to($img->carpeta.$img->nombre) }}" alt="{{$item->titulo}}">
                    <p>{{$img->epigrafe}}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-3">
                    <div class="divImgItem">
                    @if(!is_null($item->producto()->marca_principal()))
                        <img class="marcaPrincipal lazy" src="@if(!is_null($item->producto()->marca_principal()->imagen())){{URL::to($item->producto()->marca_principal()->imagen()->carpeta.$item->producto()->marca_principal()->imagen()->nombre)}}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$item->producto()->marca_principal()->nombre}}">
                    @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $item -> titulo }}</h2>
                </div>
            </div>
            @if($item->producto()->oferta())
            <div class="row">
                <div class="col-md-12">
                    <span>OFERTA: ${{$item->producto()->precio(1)}} <span>(antes: ${{$item->producto()->precio(2)}})</span></span>
                </div>
            </div>
            @elseif($item->producto()->nuevo())
            <div class="row">
                <div class="col-md-12">
                    <span>NUEVO</span>
                </div>
            </div>
            @elseif($item->producto()->precio(2) != 0)
            <div class="row">
                <div class="col-md-12">
                    <span>PRECIO: ${{ $item->producto()->precio(2) }}</span>
                </div>
            </div>
            @endif
            @if($item->producto()->cuerpo != "")
            <div class="row">
                <div class="col-md-12">
                    <h4>Descripción técnica</h4>
                    <p>{{ $item->producto()->cuerpo }}</p>
                </div>
            </div>
            @endif
            @if(count($item->archivos) > 0)
            <div class="row">
                <div class="col-md-12">
                    <h4>Descargas PDF</h4>
                </div>
            </div>
            <div class="row">
                @foreach($item->archivos as $archivo)
                <div class="col-md-12">
                    <a href="{{URL::to($archivo->carpeta.$archivo->nombre)}}" class="descargarPDF">{{$archivo->titulo}}</a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@stop