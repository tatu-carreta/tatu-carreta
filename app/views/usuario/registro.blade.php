@extends($project_name.'-master')

@section('contenido')
<section>
    <div>
        <h3>Registro</h3>
        {{ Form::open(array('url' => 'registro')) }}
        @if (Session::has('mensaje_registro'))
            <div class="divAlerta alert-success">{{ Session::get('mensaje_registro') }}</div>
        @endif
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre de Usuario" autofocus>
        </div>

        <div class="form-group">
            <label for="clave">Clave</label>
            <input type="text" id="clave" name="clave" placeholder="Clave">
        </div>

        <div class="form-group">
            <label>Perfil</label>
            <select class="form-control" name="perfil_id" required>
                <option value="">Seleccione un Perfil</option>
                @foreach($perfiles as $perfil)
                <option value='{{$perfil->id}}'>{{ $perfil->name }}</option>
                @endforeach
            </select>
        </div>

        @if($errors -> has('perfil_id'))
        <div class="alert alert-danger">
            @foreach($errors->get('perfil_id') as $error)
            *{{ $error }}<br>
            @endforeach
        </div>
        @endif

        <input type="submit" value="Registrar" class="btn">

        {{Form::close()}}

        <br>

    </div>
</section>
@stop