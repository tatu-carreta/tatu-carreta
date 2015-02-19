@extends($project_name.'-master')

@section('contenido')
    @if(Auth::check())
        <script src="{{URL::to('js/popupFuncs.js')}}"></script>
    @endif
    <section class="container @if(Auth::check()) admin @endif">
        <h2>{{ $menu -> nombre }}</h2>

        @if(Auth::check())
            @if(Auth::user()->can("ver_menu_estatico_admin"))
                <div class="bgGris">
                    <ul class="menu">
                        @if(Auth::user()->can("agregar_slide"))
                            <li><a href="{{URL::to('admin/slide/agregar/'.$menu->id.'/E')}}" class="btn nuevaSeccion"><i class="fa fa-plus fa-lg"></i>Agregar slide</a></li>
                        @endif
                        @if(Auth::user()->can("agregar_slide"))
                            <li><a href="{{URL::to('admin/slide/agregar/'.$menu->id.'/I')}}" class="btn nuevaSeccion"><i class="fa fa-plus fa-lg"></i>Agregar slide en Index</a></li>
                        @endif
                        @if(Auth::user()->can("agregar_galeria"))
                            <li><a href="{{URL::to('admin/galeria/agregar/'.$menu->id)}}" class="btn nuevaSeccion"><i class="fa fa-plus fa-lg"></i>Agregar galería</a></li>
                        @endif
                        @if(Auth::user()->can("agregar_texto"))
                            <li><a href="{{URL::to('admin/texto/agregar/'.$menu->id)}}" class="btn nuevaSeccion"><i class="fa fa-plus fa-lg"></i>Agregar texto</a></li>
                        @endif
                        @if(Auth::user()->can("agregar_html"))
                            <li><a href="{{URL::to('admin/html/agregar/'.$menu->id)}}" class="btn nuevaSeccion"><i class="fa fa-plus fa-lg"></i>Agregar HTML</a></li>
                        @endif
                    </ul>
                    @if(Auth::user()->can("ordenar_seccion_estatica"))
                        @if(count($menu->secciones) >= 2)
                            <a href="{{URL::to('admin/seccion/ordenar-por-menu/'.$menu->id)}}" class="btnSec nuevaSeccion"><i class="fa fa-exchange fa-lg"></i>Ordenar secciones</a>
                        @endif
                    @endif
                </div>
            @endif
        @endif


        @foreach($menu -> secciones as $seccion)
            @if((count($seccion->items) > 0) || (count($seccion->slides) > 0))
                @include('seccion.'.$project_name.'-ver-seccion-estatica')
            @endif
        @endforeach

        <div class="clear"></div>
        @if(Auth::check())
            <div id="agregar-seccion" style="display: none;"></div>
        @endif
    </section>
@stop