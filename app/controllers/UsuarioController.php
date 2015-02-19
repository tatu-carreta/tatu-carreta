<?php

class UsuarioController extends BaseController {

    public function login() {

        $url = Request::header('referer');

        $this->array_view['url'] = $url;

        return View::make('usuario.' . $this->project_name . '-login', $this->array_view);
    }

    public function registro() {

        $perfiles = Role::orderBy('name')->get();

        $this->array_view['perfiles'] = $perfiles;

        return View::make('usuario.registro', $this->array_view);
    }

    public function registrarUsuario() {

        $respuesta = Usuario::registrarUsuario(Input::all());

        if ($respuesta['error'] == true) {
            return Redirect::to('registro')->withErrors($respuesta['mensaje'])->withInput();
        } else {
            return Redirect::to('registro')->with('mensaje', $respuesta['mensaje']);
        }
    }

    public function loguearse() {

        $usuario = array(
            'nombre' => Input::get('nombre'),
            'password' => Input::get('clave')
        );


        $respuesta = Usuario::loguearse($usuario);

        if ($respuesta['error'] == false) {
            $url = Input::get('url');

            if (is_null($url) || ($url == "")) {
                $url = Session::get('pre_login_url');
                Session::forget('pre_login_url');
            }

            return Redirect::to($url);
        } else {
            return Redirect::to('login')->with('mensaje_login', 'Ingreso invalido');
        }
    }

    public function logout() {
        Auth::logout();

        return Redirect::to('/');
    }

    public function vistaAsignarUsuarioPermiso() {
        $usuarios = Usuario::orderBy('nombre')->get();

        $perfiles = Role::where('estado', 'A')->get();
        $permisos = Permission::all();

        $this->array_view['usuarios'] = $usuarios;
        $this->array_view['perfiles'] = $perfiles;
        $this->array_view['permisos'] = $permisos;

        return View::make('usuario.permiso.asignar-usuario-permiso', $this->array_view);
    }

}