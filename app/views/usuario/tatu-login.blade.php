@extends($project_name.'-master')

@section('contenido')
    <section>
        {{ Form::open(array('url' => 'login')) }}
            <div class="divLogin">
                <input type="text" id="nombre" placeholder="nombre de usuario" name="nombre" autofocus><br>
                <input type="password" id="clave" placeholder="contraseña" name="clave"><br>
                <input type="submit" value="Ingresar" class="btn">
            </div>
        {{Form::hidden('url', $url)}}
        {{Form::close()}}
    </section>
@stop