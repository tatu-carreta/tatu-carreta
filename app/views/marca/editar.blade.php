@extends($project_name.'-master')

@section('contenido')
    @if (Session::has('mensaje'))
    <script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
    @endif
<script>
    function verificar_cancelar(){
        if(!$(".imgMarcaCargada").length)
        {
            alert('Usted no puede Cancelar sin establecer la imagen de la Marca.');
        }
        else
        {
            window.history.back();
        }
    }
</script>
    @if (Session::has('mensaje'))
        <div class="divAlerta error alert-success">{{ Session::get('mensaje') }}<i onclick="" class="cerrarDivAlerta fa fa-times fa-lg"></i></div>
    @endif
    <section class="container">
        {{ Form::open(array('url' => 'admin/marca/editar', 'files' => true)) }}
            <h2><span>Carga y modificación de marcas</span></h2>

            <input class="block col50 marginBottom" type="text" name="nombre" placeholder="Nombre" value="{{$marca->nombre}}" required="true">

            <div class="grupoForm marginBottom2">
                <h3>Tipo de Marca</h3>
                <select class="form-control" name="tipo" required="true">
                    <option value="">Seleccione un Tipo de Marca</option>
                    <option value="P" @if($marca->tipo == "P") selected @endif>Marca de Producto</option>
                    <option value="S" @if($marca->tipo == "S") selected @endif>Marca Técnica</option>
                </select>
            </div>

            <div class="clear"></div>

            
                @if(!is_null($marca->imagen()))
                <div class="fondoDestacado padding1 marginBottom2 col50">
                    <div class="divCargaMarca">
                        <img class="imgMarcaCargada" alt="{{$marca->nombre}}"  src="{{ URL::to($marca->imagen()->carpeta.$marca->imagen()->nombre) }}">
                        <i onclick="borrarImagenReload('{{URL::to('admin/marca/quitar-imagen')}}', '{{$marca->id}}');" class="fa fa-times fa-lg"></i>
                    </div>
                    {{Form::hidden('imagen_id', $marca->imagen()->id)}}
                    <div class="clear"></div>
                </div>
                @else
                    @include('imagen.modulo-imagen-maxi')
                @endif
                

            <div>
                <input type="submit" value="Guardar" class="btn marginRight5">
                <a onclick="verificar_cancelar();" class="btnGris ">Cancelar</a>
            </div>
            <div class="clear"></div>
            {{Form::hidden('id', $marca->id)}}
        {{Form::close()}}
    </section>
@stop
