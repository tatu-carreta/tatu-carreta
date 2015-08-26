@extends($project_name.'-master')

@section('contenido')
<section class="container">
    <div class="row">
        <div class="col-md-12 marginBottom2">
            <h2>Contacto</h2>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row ">
        <div class="col-md-12 ">
            <div class="col-izqcontacto">
                <h3>La Plata</h3>
                <p>Calle 39 N° 833 e/ 11 y 12 </br>
                Teléfono: (0221) 4221273 / Fax: (0221) 4273777 </br>
                Email: ventas@offitec.com</p>
                <h3>Lomas de Zamora</h3>
                <p>Av. Hipólito Yrigoyen 9275 (ex Av. Pavón) </br>
                Teléfono: (011) 42444099 </br>
                Email: lomas@offitec.com</p>
                <div class="redesContacto">
                    <a class="facebook" href="https://www.facebook.com/profile.php?id=100001265423883&fref=ts" target="_blank"></a>
                    <a class="google" href="https://plus.google.com/101901769123903199376/posts" target="_blank"></a>
                </div>
            </div>
            <div class="col-contacto">
                <h3>Consultas</h3>
                <div class="formulario">
                    {{Form::open(array('url' => 'consulta', 'class' => 'borde'))}}
                        <div class="form-group">
                            <label for="nombre">Nombre y apellido</label>
                            {{Form::text('nombre', Input::old('nombre'),  array('id' => 'nombre','class' => 'form-control', 'required' => true))}}    
                            <!--<input type="type" class="form-control" id="ejemplo_email_1"
                                   placeholder="" name="nombre">-->
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            {{Form::email('email', Input::old('email'),  array('id' => 'email','class' => 'form-control', 'required' => true))}} 
                            <!--<input type="email" class="form-control" id="ejemplo_password_1" 
                                   placeholder="" name="email">-->
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            {{Form::text('telefono', Input::old('telefono'),  array('id' => 'telefono','class' => 'form-control', 'required' => true))}} 
                            <!--<input type="type" class="form-control" id="ejemplo_password_1" 
                                   placeholder="" name="telefono">-->
                        </div>
                        <div class="form-group">
                            <label for="consulta">Comentarios</label>
                            {{Form::textarea('consulta', Input::old('consulta'),  array('id' => 'consulta','class' => 'form-control', 'rows' => 3))}} 
                            <!--<textarea class="form-control" rows="3" name="consulta"></textarea>-->
                        </div>
                        <button type="submit" class="btn">Enviar</button>
                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</section>
@stop