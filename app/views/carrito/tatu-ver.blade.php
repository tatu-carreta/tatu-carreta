@extends($project_name.'-master')

@section('footer_consulta_form')
<div class="clear"></div>
@stop

@section('contenido')
<section>
    @if (Session::has('mensaje'))
    <div class="divAlerta ok alert-success">{{ Session::get('mensaje') }}<i onclick="" class="cerrarDivAlerta fa fa-times fa-lg"></i></div>
    @endif
    <div>
        <table>
            <tr>
                <th></th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unidad</th>
                <th>Total</th>
                <th>Borrar</th>
            </tr>
            @if(Cart::count()>0)
                @foreach(Cart::content() as $producto)
                <tr>
                    <td><img class="lazy" data-original="@if(!is_null($producto->producto->item()->imagen_destacada())){{ URL::to($producto->producto->item()->imagen_destacada()->carpeta.$producto->producto->item()->imagen_destacada()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$producto->producto->item()->titulo}}"></td>
                    <td>{{ $producto->producto->item()->titulo }}</td>
                    <td>{{ $producto->qty }}</td>
                    <td>${{ $producto->price }}</td>
                    <td>${{ $producto->subtotal }}</td>
                    <td><a href="{{URL::to('carrito/borrar/'.$producto->id.'/'.$producto->rowid)}}">Borrar</a></td>
                </tr>
                @endforeach
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td><a href="{{ URL::to('carrito/borrar') }}">Borrar Carrito</a></td>
                    <td></td>
                    <td>${{Cart::total()}}</td>
                </tr>
            @endif
        </table>
    </div>
</section>
@stop