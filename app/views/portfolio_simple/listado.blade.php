<div class="row @if(Auth::check()) sortable @endif">
    @foreach($seccion -> items as $i)

        <div class="col-md-3 col-sm-4 col-xs-4">
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

            @if(!Auth::check())
                <a class="fancybox" href="@if(!is_null($i->imagen_destacada())){{URL::to($i->imagen_destacada()->ampliada()->carpeta.$i->imagen_destacada()->ampliada()->nombre)}}@else{{URL::to('images/sinImg.gif')}}@endif" title="@if(!is_null($i->imagen_destacada())){{ $i->imagen_destacada()->ampliada()->epigrafe }}@endif" rel='group'>
            @endif
                   <img class="lazy" data-original="@if(!is_null($i->imagen_destacada())){{ URL::to($i->imagen_destacada()->carpeta.$i->imagen_destacada()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$i->titulo}}">
            @if(!Auth::check())
                </a>
            @endif

            @if(Auth::check())
                <input type="hidden" name="orden[]" value="{{$i->id}}">
            @endif            		
            </div>
        </div>

    @endforeach
</div>