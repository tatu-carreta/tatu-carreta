@extends($project_name.'-master')

@section('contenido')
    @if(Auth::check())
        @if(Auth::user()->can("ordenar_item"))
            <script>
                $(function() {
                    $('.sortable').sortable({
                        update: function(event, ui) {
                            $("#formularioOrdenImagenes").submit();
                        }
                    });
                });
            </script>
        @endif
    @endif
<section class="container">
    <div class="row">
        <div class="col-md-12 marginBottom2">
            <h2>{{ $item -> titulo }}</h2>
            <a class="volveraSeccion" href="{{URL::to('/'.$item -> seccionItem() -> menuSeccion() -> url)}}"><i class="fa fa-caret-left"></i>Volver a {{ $item -> seccionItem() -> menuSeccion() -> nombre }}</a>
            @if(Auth::check())
                @if(Auth::user()->can("editar_item"))
                <a href="{{URL::to('admin/muestra/editar/'.$item->muestra()->id)}}" data='{{$item -> seccionItem() -> id}}' style="display:none">Editar<i class="fa fa-pencil fa-lg"></i></a>
                @endif
            @endif
        </div>
    </div>
    <div class="clear"></div>
    <div class="row marginBottom2 ">
        
        @if(Auth::check())
            {{ Form::open(array('url' => 'admin/imagen/ordenar-por-item', 'id' => 'formularioOrdenImagenes')) }}
        @endif
        <div class="@if(Auth::check()) sortable @endif">
        <div class="col-md-3 col-sm-4 col-xs-4 @if(Auth::check()) cursor-move @endif">
            <div class="thumbnail">
                @if(count($item->imagen_destacada()) > 0)
                    @if(!Auth::check())
                        <a class="fancybox" href="{{URL::to($item->imagen_destacada()->ampliada()->carpeta.$item->imagen_destacada()->ampliada()->nombre)}}" title="{{ $item->imagen_destacada()->ampliada()->epigrafe }}" rel='group'>
                    @endif
                        <img src="{{ URL::to($item->imagen_destacada()->carpeta.$item->imagen_destacada()->nombre) }}" alt="{{$item->titulo}}">
                    @if(!Auth::check())
                        </a>
                    @endif
                    {{-- <p>{{$item->imagen_destacada()->epigrafe}}</p> --}}
                @else
                    @if(!Auth::check())
                        <a class="fancybox" href="{{ URL::to('images/sinImg.gif') }}" title="{{$item->titulo}}" rel='group'>
                    @endif
                        <img src="{{ URL::to('images/sinImg.gif') }}" alt="{{$item->titulo}}">
                    @if(!Auth::check())
                        </a>
                    @endif
                @endif
                @if(Auth::check())
                    <input type="hidden" name="orden[]" value="{{$item->imagen_destacada()->id}}">
                @endif   
            </div>
        </div>
        
        @foreach($item->imagenes as $img)
            <div class="col-md-3 col-sm-4 col-xs-4 @if(Auth::check()) cursor-move @endif">
                <div class="thumbnail ">
                    @if(!Auth::check())
                        <a class="fancybox" href="{{URL::to($img->ampliada()->carpeta.$img->ampliada()->nombre)}}" title="{{ $img->ampliada()->epigrafe }}" rel='group'>
        @endif
                            <img src="{{ URL::to($img->carpeta.$img->nombre) }}" alt="{{$item->titulo}}">
                    @if(!Auth::check())    
                        </a>
                    @endif
                    {{-- <p>{{$img->epigrafe}}</p> --}}
                    @if(Auth::check())
                        <input type="hidden" name="orden[]" value="{{$img->id}}">
                    @endif    
                </div>
            </div>
            
        @endforeach
    </div>
        
        @if(Auth::check())
            {{Form::hidden('item_id', $item->id)}}
            {{Form::close()}}
        @endif
    </div>
    <div class="clear"></div>
    <div class="row ">
        <div class="col-md-12 divCuerpoTxt">
            {{ $item->muestra()->cuerpo }}
        </div>
    </div>
    
    @if(count($item->videos) > 0)
        {{--<div class="row ">
            <div class="col-md-12">
                <h3>Videos</h3>
            </div>
        </div>
        --}}
        <div class="row">
            @foreach($item->videos as $video)
                <div class="col-md-4">
                    <iframe class="video-tc" src="@if($video->tipo == 'youtube')https://www.youtube.com/embed/@else//player.vimeo.com/video/@endif{{ $video->url }}"></iframe>
                </div>
            @endforeach
        </div>
    @endif
</section>
@stop
