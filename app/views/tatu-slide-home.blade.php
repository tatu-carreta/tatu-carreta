
<script src="{{URL::to('js/jquery.cross-slide.min.js')}}"></script>
<script>
    $(function() {
        $('.slide').crossSlide({
        speed: 60,
                fade: 1
        }, [
            @if (!is_null($slide_index) && !is_null($slide_index -> imagenes))
                @foreach($slide_index -> imagenes as $img)
                    { src: "{{ URL::to($img->carpeta.$img->nombre) }}", dir: 'up'},
                @endforeach
            @else
                { src: "{{URL::to('images/slide-1.jpg')}}", dir: 'up'   },
                { src: "{{URL::to('images/slide-2.jpg')}}", dir: 'down' },
                { src: "{{URL::to('images/slide-1.jpg')}}", dir: 'up'   },
                { src: "{{URL::to('images/slide-2.jpg')}}", dir: 'down' }
            @endif
        ]);
    });
</script>

<div class="slide"></div>
