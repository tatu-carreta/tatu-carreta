@extends($project_name.'-master')

@section('contenido')
    @if(isset($page) && ($page != ""))
        @if((isset($ancla) && ($ancla != "")))
            <a id="ancla" href="{{ $ancla }}" style="display: none;">Ancla</a>
            <a id="anclaProd" href="{{ $anclaProd }}" style="display: none;">Ancla</a>
        @endif
    @endif
    @if(Auth::check())
        @if((isset($ancla) && ($ancla != "")))
            <a id="ancla" href="{{ $ancla }}" style="display: none;">Ancla</a>
        @endif
        <script src="{{URL::to('js/popupFuncs.js')}}"></script>
        @if(Auth::user()->can("ordenar_item"))
        <script>
            $(function() {
                $('.sortable').sortable({
                    update: function(event, ui) {
                        $("#formularioOrdenSeccion").submit();
                    }
                });
            });
        </script>
        @endif
    @endif
    @if(Session::has('anclaProd'))
        <a id="ancla" href="{{ Session::get('anclaProd') }}" style="display: none;">Ancla</a>
        @endif
    <!-- S E C T I O N -->
    <section class="container">
        
        <div class="row">
            <div class="col-md-12 marginBottom2">
                <h2 class="pull-left">{{ $menu->nombre }}</h2>
                @if(Auth::check())
                    <div class="pull-right">
                    @if(count($menu->secciones) >= 2)
                        @if(Auth::user()->can("convertir_subcategoria"))
                            <a  onclick="pasarSeccionesCategoria('../admin/menu/pasar-secciones-categoria', '{{$menu->id}}');" class="btn"><i class="icon-subcategoria"></i>Convertir en subcategorías</a>
                        @endif
                        @if(Auth::user()->can("ordenar_seccion_dinamica"))
                            <a href="{{URL::to('admin/seccion/ordenar-por-menu/'.$menu->id)}}" class="btn popup-nueva-seccion"><i class="fa fa-exchange fa-lg"></i>Ordenar secciones</a>
                        @endif
                    @endif
                    @if(Auth::user()->can("agregar_seccion"))
                        <a href="{{URL::to('admin/seccion/agregar/'.$menu->id)}}" class="btn btn-primary popup-nueva-seccion"><i class="fa fa-plus fa-lg"></i>Nueva sección</a>
                    @endif
                    </div>
                    <div class="clearfix"></div>
                @endif
            </div>
        </div>
        <div class="contenedorSecciones">
            @if((!$hay_datos) && (!Auth::check()))
                <div class="row">
                    <div class="col-md-12">
                        No hay {{$texto_modulo}} aún.
                    </div>
                </div>
            @else
                @include('seccion.seccion-contenedor')
            @endif
        </div>

        @if(Auth::check())
            <div class="modal fade" id="nueva-seccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                    </div>
                </div>
            </div>
        @endif
    </section>
@stop