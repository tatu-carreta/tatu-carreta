<script>
    // For Demo purposes only (show hover effect on mobile devices)
    [].slice.call( document.querySelectorAll('a[href="#"') ).forEach( function(el) {
        el.addEventListener( 'click', function(ev) { ev.preventDefault(); } );
    } );
</script>

<div class="row @if(Auth::check()) sortable @endif">
    @foreach($seccion -> items as $i)

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
            <div class="thumbnail">
                @if(Auth::check())
                    <div class="iconos">
                        <span class="pull-left">
                            @if(!$i->destacado())
                                @if(Auth::user()->can("destacar_item"))
                                    <i onclick="destacarItemSeccion('{{URL::to('admin/item/destacar')}}', '{{$seccion->id}}', '{{$i->id}}');" class="fa fa-thumb-tack fa-lg"></i>
                                @endif
                            @else
                                @if(Auth::user()->can("quitar_destacado_item"))
                                    <i onclick="destacarItemSeccion('{{URL::to('admin/item/quitar-destacado')}}', '{{$seccion->id}}', '{{$i->id}}');" class="fa fa-thumb-tack prodDestacado fa-lg"></i>
                                @endif
                            @endif
                            <a href="{{URL::to('portfolio_completo/'.$i->url)}}"><i class="fa fa-eye fa-lg"></i></a>
                        </span>
                        <span class="pull-right">
                            @if(Auth::user()->can("editar_item"))
                                <a href="{{URL::to('admin/'.$seccion->menuSeccion()->modulo()->nombre.'/editar/'.$i->id.'/seccion')}}" data='{{$seccion->id}}'><i class="fa fa-pencil fa-lg"></i></a>
                            @endif
                            @if(Auth::user()->can("borrar_item"))
                                <i onclick="borrarData('{{URL::to('admin/item/borrar')}}', '{{$i->id}}');" class="fa fa-times fa-lg"></i>
                            @endif
                        </span>
                        <div class="clearfix"></div>
                    </div>
                @endif
                <div class="grid">
                    <div class="effect-milo @if(Auth::check()) cursor-move @endif">
                        @if(!Auth::check())
                            <a href="{{URL::to('portfolio_completo/'.$i->url)}}">
                        @endif
                            <img class="lazy" data-original="@if(!is_null($i->imagen_destacada())){{ URL::to($i->imagen_destacada()->carpeta.$i->imagen_destacada()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$i->titulo}}">
                            <figcaption><p class="pull-left">{{ $i->titulo }}</p></figcaption>
                        @if(!Auth::check())
                            </a>
                        @endif
                    </div>
                </div>
                @if(Auth::check())
                    <input type="hidden" name="orden[]" value="{{$i->id}}">
                @endif            		
            </div>
        </div>

    @endforeach

</div>
