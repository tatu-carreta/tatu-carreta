@foreach($menu_dinamico as $m)
    @if(count($m->children) > 0)
    <li class='active has-sub'>
    <a href="#" data-id="{{$m->id}}" data-nivel="1">{{$m->nombre}}</a>
        <ul>
            @foreach($m->children as $c)
                @if(count($c->children) > 0)
                    {{-- Si el hijo tiene mas hijos--}}
                    <li class='active has-sub'><a href="#" data-id="{{$m->id}}" data-nivel="2">{{$c->nombre}}  </a>
                        <ul>
                            @foreach($c->children as $c1)
                                @if(count($c1->children) > 0)
                                    {{-- Si a su vez el segundo hijo tiene mas hijos--}}
                                    <li class='active has-sub'><a href="#" data-id="{{$m->id}}" data-nivel="3">{{$c1->nombre }}</a>
                                        <ul>
                                            @foreach($c1->children as $c2)
                                                @if(count($c2->children) > 0)
                                                    <li>{{ HTML::link('#', $c2->nombre) }}</li>
                                                @else
                                                    <li>{{ HTML::link('/'.$c2->url, $c2->nombre) }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li>{{ HTML::link('/'.$c1->url, $c1->nombre) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>{{ HTML::link('/'.$c->url, $c->nombre) }}</li>
                @endif
            @endforeach
        </ul>
    @else
        <li>
        {{ HTML::link('/'.$m->url, $m->nombre) }}
    @endif
    </li>
@endforeach
