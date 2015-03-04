@extends($project_name.'-master')

@section('contenido')
    @if (Session::has('mensaje'))
    <script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
    @endif
    <script src="{{URL::to('js/ckeditorLimitado.js')}}"></script>
    
    <section class="container">
        @if (Session::has('mensaje'))
            <div class="divAlerta error alert-success">{{ Session::get('mensaje') }}<i onclick="" class="cerrarDivAlerta fa fa-times fa-lg"></i></div>
        @endif
        {{ Form::open(array('url' => 'admin/direccion/agregar')) }}
            <h2 class="marginBottom2"><span>Carga y modificación de direccion</span></h2>
            <div id="error" class="error" style="display:none"><span></span></div>
            <div id="correcto" class="correcto ok" style="display:none"><span></span></div>

            <!-- Abre columna de descripción -->
            <div class="col70Admin datosProducto">
                <h3>Calle</h3>
                <input class="block anchoTotal marginBottom" type="text" name="calle" placeholder="Calle" required="true" maxlength="100">

                <h3>Numero</h3>
                <input class="block anchoTotal marginBottom fecha" type="text" name="numero" placeholder="Numero" required="true" maxlength="50">

                <h3>Piso</h3>
                <input class="block anchoTotal marginBottom" type="text" name="piso" placeholder="Piso" required="true" maxlength="50">

                <h3>Departamento</h3>
                <input class="block anchoTotal marginBottom" type="text" name="departamento" placeholder="Departamento" required="true" maxlength="200">

                <h3>Ciudad</h3>
                <input class="block anchoTotal marginBottom" type="text" name="ciudad_id" placeholder="Ciudad ID" required="true" maxlength="200">
            </div>
            
            <div class="clear"></div>
            <!-- cierran columnas -->
            
            <div class="punteado">
                <input type="hidden" name="latitud">
                <input type="hidden" name="longitud">
                <input type="submit" value="Publicar" class="btn marginRight5">
                <a onclick="window.history.back();" class="btnGris">Cancelar</a>
            </div>
        {{Form::close()}}
    </section>
@stop
