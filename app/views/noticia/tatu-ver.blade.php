@extends($project_name.'-master')

@section('contenido')
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
            <a href="{{URL::to('admin/noticia/editar/'.$item->texto()->noticia()->id)}}" data='{{$item -> seccionItem() -> id}}' style="display:none">Editar<i class="fa fa-pencil fa-lg"></i></a>
            @endif
        @endif
        
        <!--columna Noticia -->
        <div class="divNoticia"> 
            <div class="divCpoNoticia colTextos bordeVerdeLateral paddingTextos">
                <h2>{{ $item -> titulo }}</h2>
                <div class="editor">
                    <p class="fecha">{{ date('d/m/Y', strtotime($item->texto()->noticia()->fecha)) }}</p>
                    <p>Fuente: <strong>{{ $item->texto()->noticia()->fuente }}</strong></p>
                    <p class="bajada">{{ $item->descripcion }}</p>
                </div>
                <div class="editor">
                    <p>{{ $item->texto()->cuerpo }}</p>
                </div>
            </div>
        
            <div class="imgCpoNoticia colFotos">
                @if(count($item->imagen_destacada()) > 0)
                        <img src="{{ URL::to($item->imagen_destacada()->ampliada()->carpeta.$item->imagen_destacada()->ampliada()->nombre) }}" alt="{{$item->titulo}}">
                        <p class="epigrafe">{{$item->imagen_destacada()->ampliada()->epigrafe}}</p>
                @else
                    <li><img src="{{ URL::to('images/sinImg.gif') }}" alt="{{$item->titulo}}"></li>
                @endif
            </div>
            <div class="clear"></div>
        </div>
    </div>
</section>
@stop