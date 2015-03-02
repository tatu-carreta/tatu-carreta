<ul>
@foreach($menus as $m)
    @if(count($m->children) > 0)
    <li>
    <a href="#" class='has-sub btn0' data-id="{{$m->id}}" data-nivel="1">{{$m->nombre}}</a>
        <ul>
            <?php $i = 1; ?>
            @foreach($m->children as $c)
                @if(count($c->children) > 0)
                    {{-- Si el hijo tiene mas hijos--}}
                    <li><a href="#" data-id="{{$m->id}}" data-nivel="2">{{$c->nombre}}  </a>
                        <ul>
                            @foreach($c->children as $c1)
                                @if(count($c1->children) > 0)
                                    {{-- Si a su vez el segundo hijo tiene mas hijos--}}
                                    <li><a href="#" data-id="{{$m->id}}" data-nivel="3">{{$c1->nombre }}</a>
                                        <ul>
                                            @foreach($c1->children as $c2)
                                                @if(count($c2->children) > 0)
                                                    <li>{{ HTML::link('#', $c2->nombre) }}</li>
                                                @else
                                                    <li>
                                                        <a href="{{URL::to('/'.$c2->url)}}" class="btn1">{{$c2->nombre}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{URL::to('/'.$c1->url)}}" class="btn1">{{$c1->nombre}}</a>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{URL::to('/'.$c->url)}}" class="btn{{$i}}">{{$c->nombre}}</a>
                    </li>
                @endif
                <?php $i++; ?>
            @endforeach
        </ul>
    @else
        <li>
            <a href="{{URL::to('/'.$m->url)}}" class="btn1">{{$m->nombre}}</a>
    @endif
    </li>
@endforeach
</ul>