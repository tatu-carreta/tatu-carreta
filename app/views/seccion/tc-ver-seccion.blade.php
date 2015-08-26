<div class="divProductos">
    @if(($seccion->titulo != "") || (Auth::check()))<h3 class="floatLeft marginRight" id="{{$seccion->estado.$seccion->id}}">@if($seccion->titulo != ""){{ $seccion -> titulo }} @endif</h3>@endif
    @if(Auth::check())
        @if(Auth::user()->can("editar_seccion"))
            <a href="{{URL::to('admin/seccion/editar/'.$seccion->id)}}" data='{{ $seccion->id }}' class="btnSec nuevaSeccion"><i class="fa fa-pencil fa-lg"></i>Cambiar nombre</a>
        @endif
        @if(Auth::user()->can("borrar_seccion"))
            <a onclick="borrarData('../admin/seccion/borrar', '{{$seccion->id}}');" class="btnSec"><i class="fa fa-times fa-lg"></i>Eliminar sección</a>
        @endif
        @if(Auth::user()->can("agregar_item"))
            <a href="{{URL::to('admin/noticia/agregar/'.$seccion->id)}}" data='{{ $seccion->id }}' class="btn floatRight"><i class="fa fa-plus fa-lg"></i>Nuevo Producto</a>
        @endif
    @endif
    <div class="clear"></div>

    @if(count($seccion->items) > 0)
    @if(Auth::check())
    {{ Form::open(array('url' => 'admin/item/ordenar-por-seccion')) }}
    @endif
    <ul class="ulProductos @if(Auth::check()) sortable @endif">
            @foreach($seccion -> items as $i)
            <li>
                @if(Auth::check())
                <div class="iconos">
                    @if(!$i->destacado())
                        @if(Auth::user()->can("destacar_item"))
                            <i onclick="destacarItemSeccion('../admin/item/destacar', '{{$seccion->id}}', '{{$i->id}}');" class="fa fa-thumb-tack fa-lg"></i>
                        @endif
                    @else
                        @if(Auth::user()->can("quitar_destacado_item"))
                            <i onclick="destacarItemSeccion('../admin/item/quitar-destacado', '{{$seccion->id}}', '{{$i->id}}');" class="fa fa-thumb-tack prodDestacado fa-lg"></i>
                        @endif
                    @endif

                    <span class="floatRight">
                        @if(Auth::user()->can("editar_item"))
                        <a href="{{URL::to('admin/noticia/editar/'.$i->texto()->noticia()->id.'/seccion')}}" data='{{$seccion->id}}'><i class="fa fa-pencil fa-lg"></i></a>
                        @endif
                        @if(Auth::user()->can("borrar_item"))
                            <i onclick="borrarData('../admin/item/borrar', '{{$i->id}}');" class="fa fa-times fa-lg"></i>
                        @endif
                    </span>
                </div>
                @endif

                @if(!Auth::check())
                    <a href="{{URL::to('noticia/'.$i->url)}}">
                @endif
                <img class="lazy" data-original="@if(!is_null($i->imagen_destacada())){{ URL::to($i->imagen_destacada()->carpeta.$i->imagen_destacada()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$i->titulo}}">
                @if(!Auth::check())
                    </a>
                @endif

                <p class="tituloProducto"><span>{{ $i->titulo }}</span></p>
                <a class="detalle" href="{{URL::to('noticia/'.$i->url)}}">Detalle</a>	
                @if(Auth::check())
                <input type="hidden" name="orden[]" value="{{$i->id}}">
                @endif            		
            </li>
            @endforeach
        
    </ul>

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