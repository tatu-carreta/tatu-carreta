@extends($project_name.'-master')

@section('contenido')
<section>
    <div>
        <h2>Envíenos su consulta:</h2>
        <div class="colForm">
            {{Form::open(array('url' => 'consulta'))}}
                <label>Nombre y apellido<br>
                    <input name="nombre" type="text" required>
                </label>
                <label>Teléfono<br>	
                    <input name="telefono" type="text" required>
                </label>
                <label>E-mail<br>
                    <input name="email" type="email" required>
                </label>
                <label>Consulta<br>
                    <textarea name="consulta"></textarea>
                </label>
                <input type="submit" value="consultar">
            {{Form::close()}}
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</section>
@stop