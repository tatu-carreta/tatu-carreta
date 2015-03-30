@extends($project_name.'-master')

@section('contenido')
    @if(isset($page) && ($page != ""))
        @if(isset($ancla) && ($ancla != ""))
            <script src="{{URL::to('js/anclaFuncs.js')}}"></script>
            <a id="ancla" href="{{ $ancla }}" style="display: none;">Ancla</a>
        @endif
    @endif
    @if(Auth::check())
        @if(isset($ancla) && ($ancla != ""))
            <script src="{{URL::to('js/anclaFuncs.js')}}"></script>
            <a id="ancla" href="{{ $ancla }}" style="display: none;">Ancla</a>
        @endif
        <script src="{{URL::to('js/popupFuncs.js')}}"></script>
        @if(Auth::user()->can("ordenar_item"))
        <script>
            $(function() {
                $('.sortable').sortable({
                    update: function(event, ui) {
                        $(this).parent().submit();
                    }
                });
            });
        </script>
        @endif
    @endif
    <section>
    	<div>
	    <h2>{{ $menu->nombre }}</h2>
            @if(Auth::check())
                <div class="divNuevaSeccion">
                    <div class="floatRight">
                    @if(count($menu->secciones) >= 2)
                        @if(Auth::user()->can("convertir_subcategoria"))
                            <a  onclick="pasarSeccionesCategoria('../admin/menu/pasar-secciones-categoria', '{{$menu->id}}');" class="btnSec"><i class="icon-subcategoria"></i>Convertir en subcategorías</a>
                        @endif
                        @if(Auth::user()->can("ordenar_seccion_dinamica"))
                            <a href="{{URL::to('admin/seccion/ordenar-por-menu/'.$menu->id)}}" class="btnSec nuevaSeccion"><i class="fa fa-exchange fa-lg"></i>Ordenar secciones</a>
                        @endif
                    @endif
                    @if(Auth::user()->can("agregar_seccion"))
                        <a href="{{URL::to('admin/seccion/agregar/'.$menu->id)}}" class="btn nuevaSeccion"><i class="fa fa-plus fa-lg"></i>Nueva sección</a>
                    @endif
                    </div>
                    <div class="clear"></div>
                </div>
            @endif
            
            <div>
                @include('seccion.seccion-contenedor')
            </div>
        </div>

        @if(Auth::check())
            <div id="agregar-seccion"></div>
        @endif
    </section>
@stop