@foreach($menu -> secciones as $seccion)
    @if((count($seccion->items) > 0) || Auth::check())
        <div id="{{$menu->estado.$menu->id}}">
            @if(($seccion->titulo != "") || (Auth::check()))
                <h3 class="floatLeft marginRight" id="{{$seccion->estado.$seccion->id}}">
                    @if($seccion->titulo != "")
                        {{ $seccion -> titulo }}
                    @else 
                        @if(Auth::check()) 
                            Sección sin título {{ $seccion->id }}
                        @endif 
                    @endif
                </h3>
            @endif

            @if(Auth::check())
                @if(Auth::user()->can("editar_seccion"))
                    <a href="{{URL::to('admin/seccion/editar/'.$seccion->id)}}" data='{{ $seccion->id }}' class="btnSec nuevaSeccion"><i class="fa fa-pencil fa-lg"></i>Cambiar nombre</a>
                @endif
                @if(Auth::user()->can("borrar_seccion"))
                    <a onclick="borrarData('../admin/seccion/borrar', '{{$seccion->id}}');" class="btnSec"><i class="fa fa-times fa-lg"></i>Eliminar sección</a>
                @endif
                @if(Auth::user()->can("agregar_item"))
                    <a href="{{URL::to('admin/'.$menu->modulo()->nombre.'/agregar/'.$seccion->id)}}" data='{{ $seccion->id }}' class="btn floatRight"><i class="fa fa-plus fa-lg"></i>{{$texto_agregar}}</a>
                @endif
            @endif
            <div class="clear"></div>



            @if(count($seccion->items) > 0)
                @if(Auth::check())
                    {{ Form::open(array('url' => 'admin/item/ordenar-por-seccion')) }}
                @endif
                
                @include($html)
                
                {{-- {{$seccion->items_noticias()['paginador']->links()}} --}}

                <div class="clear"></div>

                @if(Auth::check())
                    {{Form::hidden('seccion_id', $seccion->id)}}
                    {{Form::close()}}
                @endif
            @else
                @if(!Auth::check())
                    No hay noticias cargadas aún.
                @endif
            @endif
            <div class="clear"></div>

            @if(Auth::check())
                <div id="agregar-item{{ $seccion->id }}"></div>
                <div id="destacar-producto"></div>
            @endif
        </div>
    @endif
@endforeach