<ul class="listaNoticias @if(Auth::check()) sortable @endif">
    @foreach($seccion -> items as $i)
        <li>
            @if(Auth::check())
            <div class="iconos">
                @if(!$i->destacado())
                    @if(Auth::user()->can("destacar_item"))
                        <i onclick="destacarItemSeccion('{{URL::to('admin/item/destacar')}}', '{{$seccion->id}}', '{{$i->id}}');" class="fa fa-thumb-tack fa-lg"></i>
                    @endif
                @else
                    @if(Auth::user()->can("quitar_destacado_item"))
                        <i onclick="destacarItemSeccion('{{URL::to('admin/item/quitar-destacado')}}', '{{$seccion->id}}', '{{$i->id}}');" class="fa fa-thumb-tack prodDestacado fa-lg"></i>
                    @endif
                @endif

                <span class="floatRight">
                    @if(Auth::user()->can("editar_item"))
                    <a href="{{URL::to('admin/portfolio_completo/editar/'.$i->portfolio()->portfolio_completo()->id.'/seccion')}}" data='{{$seccion->id}}'><i class="fa fa-pencil fa-lg"></i></a>
                    @endif
                    @if(Auth::user()->can("borrar_item"))
                        <i onclick="borrarData('{{URL::to('admin/item/borrar')}}', '{{$i->id}}');" class="fa fa-times fa-lg"></i>
                    @endif
                </span>
            </div>
            @endif

            @if(!Auth::check())
                <a href="{{URL::to('portfolio_completo/'.$i->url)}}">
            @endif
                    <div class="divImgNoticia">
                        <img class="lazy" data-original="@if(!is_null($i->imagen_destacada())){{ URL::to($i->imagen_destacada()->carpeta.$i->imagen_destacada()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$i->titulo}}">
                        @if(!is_null($i->imagen_destacada()))
                        <p>{{$i->imagen_destacada()->epigrafe}}</p>
                        @endif
                        <h3>{{$i->titulo}}</h3>
                        <p class="bajada">{{$i->descripcion}}</p>
                        @if(count($i->imagenes) > 0)
                            <ul>
                                @foreach($i->imagenes as $img)
                                <li>
                                    <img src="{{ URL::to($img->carpeta.$img->nombre) }}" alt="{{$i->titulo}}" title="{{$img->epigrafe}}">
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="clear"></div>
            @if(!Auth::check())
                </a>
            @endif

            @if(Auth::check())
            <input type="hidden" name="orden[]" value="{{$i->id}}">
            @endif            		
        </li>
    @endforeach
</ul>