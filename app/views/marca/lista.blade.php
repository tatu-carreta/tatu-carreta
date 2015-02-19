@extends($project_name.'-master')

@section('contenido')
        @if (Session::has('mensaje'))
        <script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
        @endif
    <section>
        @if (Session::has('mensaje'))
            <div class="divAlerta ok alert-success">{{ Session::get('mensaje') }}<i onclick="" class="cerrarDivAlerta fa fa-times fa-lg"></i></div>
        @endif
        <div class="container">

        <h2><span>Administración de Marcas</span></h2>

        @if(Auth::user()->can("agregar_marca"))
            <a href="{{URL::to('admin/marca/agregar/')}}" class="btn floatRight"><i class="fa fa-plus fa-lg"></i>Nueva Marca</a>
        @endif
        
        <div>
            <h3>Marcas de Producto</h3>
            <ul class="listaMarcas">
                @foreach($marcas_principales as $marca)
                    <li>
                        <div class="iconos">
                            <span class="floatRight">
                                @if(Auth::user()->can("editar_marca"))
                                    <a href="{{URL::to('admin/marca/editar/'.$marca->id)}}"><i class="fa fa-pencil fa-lg"></i></a>
                                @endif
                                @if(Auth::user()->can("borrar_marca"))
                                    <i onclick="borrarData('{{URL::to('admin/marca/borrar')}}', '{{$marca->id}}');" class="fa fa-times fa-lg"></i>
                                @endif
                            </span>
                        </div>
                        
                        <img class="lazy" data-original="@if(!is_null($marca->imagen())){{ URL::to($marca->imagen()->carpeta.$marca->imagen()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$marca->nombre}}">
                        <p class="marca"><span>{{$marca->nombre}}</span></p>
                    </li>
                @endforeach
                <div class="clear"></div>
            </ul>
        </div>
        <div class="clear"></div>
        <div>
            <h3>Marcas Técnicas</h3>
            <ul class="listaMarcas">
                @foreach($marcas_secundarias as $marca)
                    <li>
                        <div class="iconos">
                                <span class="floatRight">
                                    @if(Auth::user()->can("editar_marca"))
                                    <a href="{{URL::to('admin/marca/editar/'.$marca->id)}}"><i class="fa fa-pencil fa-lg"></i></a>
                                    @endif
                                    @if(Auth::user()->can("borrar_marca"))
                                    <i onclick="borrarData('{{URL::to('admin/marca/borrar')}}', '{{$marca->id}}');" class="fa fa-times fa-lg"></i>
                                    @endif
                                </span>
                        </div>
                        <img class="lazy" data-original="@if(!is_null($marca->imagen())){{ URL::to($marca->imagen()->carpeta.$marca->imagen()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$marca->nombre}}">
                        <p class="marca"><span>{{$marca->nombre}}</span></p>
                    </li>
                @endforeach
                <div class="clear"></div>
            </ul>
        </div>

        </div>
    </section>

@stop