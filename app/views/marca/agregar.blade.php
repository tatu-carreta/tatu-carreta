@extends($project_name.'-master')

@section('contenido')
    @if (Session::has('mensaje'))
    <script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
    @endif
    <section>
        @if (Session::has('mensaje'))
            <div class="divAlerta error alert-success">{{ Session::get('mensaje') }}<i onclick="" class="cerrarDivAlerta fa fa-times fa-lg"></i></div>
        @endif
        <div class="container">

            {{ Form::open(array('url' => 'admin/marca/agregar', 'files' => true)) }}
                <h2><span>Carga y modificación de marcas</span></h2>

                <input class="block col50 marginBottom" type="text" name="nombre" placeholder="Nombre" required="true">

                <div class="grupoForm marginBottom2">
                    <h3>Tipo de Marca</h3>
                    <select class="form-control" name="tipo" required="true">
                        <option value="">Seleccione un Tipo de Marca</option>
                        <option value="P">Marca de Producto</option>
                        <option value="S">Marca Técnica</option>
                    </select>
                </div>
                <div class="clear"></div>

                @include('imagen.modulo-imagen-maxi')

                <div>
                    <input type="submit" value="Publicar" class="btn marginRight5">
                    <a onclick="window.history.back();" class="btnGris">Cancelar</a>
                </div>
                <div class="clear"></div>
            {{Form::close()}}
            
        </div>
    </section>
@stop
