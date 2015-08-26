@extends($project_name.'-master')

@section('head')

    @parent

    <link rel="stylesheet" href="{{URL::to('css/ng-img-crop.css')}}" />
@stop

@section('contenido')
    @if (Session::has('mensaje'))
    <script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
    @endif
    <section class="container">
        {{ Form::open(array('url' => 'admin/portfolio_simple/agregar', 'files' => true, 'role' => 'form')) }}
            <h2 class="marginBottom2"><span>Nueva obra</span></h2>
        
            <div class="row marginBottom2">
                <!-- Abre columna de imágenes -->
                <div class="col-md-12 cargaImg">
                	<div class="fondoDestacado">
	                    <h3>Recorte de imágenes</h3>
	                    @include('imagen.modulo-imagen-angular-crop-horizontal')
	                </div>
                </div>
            </div>  
            

            <div class="borderTop">
                <input type="submit" value="Publicar" class="btn btn-primary marginRight5">
                <a onclick="window.history.back();" class="btn btn-default">Cancelar</a>
            </div>


            {{Form::hidden('seccion_id', $seccion_id)}}
            {{Form::hidden('titulo', '')}}
            {{Form::hidden('descripcion', '')}}
        {{Form::close()}}
    </section>
@stop

@section('footer')

    @parent

    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js"></script>
    <script src="{{URL::to('js/angular-file-upload.js')}}"></script>
    <script src="{{URL::to('js/ng-img-crop.js')}}"></script>
    <script src="{{URL::to('js/controllers.js')}}"></script>

@stop