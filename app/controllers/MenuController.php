<?php

class MenuController extends BaseController {

    public function vistaListado() {

        $categorias = parent::desplegarCategoria();

        $this->array_view['categorias'] = $categorias;

        $modulos = Modulo::all();

        $this->array_view['modulos'] = $modulos;

        //return View::make('menu.lista', array('menus' => $menus, 'categorias' => $categorias));
        return View::make('menu.administrar', $this->array_view);
    }

    public function vistaAgregar() {

        return View::make('menu.crear', $this->array_view);
    }

    public function agregar() {

        $respuesta = Menu::agregarMenu(Input::all());

        if ($respuesta['error'] == true) {
            return Redirect::to('admin/menu')->withErrors($respuesta['mensaje'])->withInput();
        } else {
            return Redirect::to('admin/menu')->with('mensaje', $respuesta['mensaje']);
        }
    }

    public function mostrarInfoMenu($url) {

        $menu = Menu::where('url', $url)->where('estado', 'A')->first();

        if ($menu) {
            $this->array_view['menu'] = $menu;

            if (!is_null($menu->categoria())) {
                $this->array_view['ancla'] = Session::get('ancla');

                switch ($menu->modulo()->nombre) {
                    case "producto":
                        $marcas = array();
                        foreach ($menu->secciones as $seccion) {
                            if (count($seccion->items) > 0) {
                                foreach ($seccion->items as $item) {
                                    if (!is_null($item->producto())) {
                                        if (!is_null($item->producto()->marca_principal())) {
                                            array_push($marcas, $item->producto()->marca_principal()->id);
                                        }
                                    }
                                }
                            }
                        }

                        if (count($marcas) > 0) {
                            $marcas_principales = Marca::where('tipo', 'P')->whereIn('id', $marcas)->where('estado', 'A')->orderBy('nombre')->get();
                        } else {
                            $marcas_principales = array();
                        }

                        $this->array_view['marcas_principales'] = $marcas_principales;

                        $textoAgregar = "Nuevo Producto";
                        break;
                    case "noticia":
                        $this->array_view['ancla'] = "#" . $menu->estado . $menu->id;

                        $textoAgregar = "Nueva Noticia";
                        break;
                    case "evento":
                        $textoAgregar = "Nuevo Evento";
                        break;
                    case "portfolio_simple":
                        $textoAgregar = "Nuevo Portfolio Simple";
                        break;
                    case "portfolio_completo":
                        $textoAgregar = "Nuevo Portfolio Completo";
                        break;
                    default :
                        $textoAgregar = "Nuevo Item";
                        break;
                }

                $this->array_view['html'] = $menu->modulo()->nombre . ".listado";
                $this->array_view['texto_agregar'] = $textoAgregar;

                return View::make("menu.menu-contenedor", $this->array_view);
            } else {
                return View::make('menu.' . $this->project_name . '-ver-menu-estatico', $this->array_view);
            }
        } else {
            $this->array_view['texto'] = 'Página de Error!!';
            return View::make($this->project_name . '-error', $this->array_view);
        }
    }

    public function mostrarInfoMenuPorMarca($url, $marca) {

        $menu = Menu::where('url', $url)->where('estado', 'A')->first();

        if ($menu) {
            $this->array_view['menu'] = $menu;
            if (!is_null($menu->categoria())) {
                $marcas = array();
                foreach ($menu->secciones as $seccion) {
                    if (count($seccion->items) > 0) {
                        foreach ($seccion->items as $item) {
                            if (!is_null($item->producto())) {
                                if (!is_null($item->producto()->marca_principal())) {
                                    array_push($marcas, $item->producto()->marca_principal()->id);
                                }
                            }
                        }
                    }
                }

                $marcas_principales = Marca::where('tipo', 'P')->whereIn('id', $marcas)->where('estado', 'A')->orderBy('nombre')->get();

                $this->array_view['marcas_principales'] = $marcas_principales;
                $this->array_view['marca_id'] = $marca;
                $this->array_view['ancla'] = Session::get('ancla');
                return View::make('menu.' . $this->project_name . '-ver-menu', $this->array_view);
            } else {
                return View::make('menu.' . $this->project_name . '-ver-menu-estatico', $this->array_view);
            }
        } else {
            $this->array_view['texto'] = 'Página de Error!!';
            return View::make($this->project_name . '-error', $this->array_view);
        }
    }

    public function vistaEditar($id) {

        $menu = Menu::find($id);

        if ($menu) {
            $this->array_view['menu'] = $menu;
            return View::make('menu.editar', $this->array_view);
        } else {
            $this->array_view['texto'] = 'Página de Error!!';
            return View::make($this->project_name . '-error', $this->array_view);
        }
    }

    public function editar() {

        $respuesta = Menu::editarMenu(Input::all());

        if ($respuesta['error'] == true) {
            return Redirect::to('admin/menu')->withErrors($respuesta['mensaje'])->withInput();
        } else {
            return Redirect::to('admin/menu')->with('mensaje', $respuesta['mensaje']);
        }
    }

    public function borrar() {

        $respuesta = Menu::borrarMenu(Input::all());

        return $respuesta;
    }

    public function pasarSeccionesCategoria() {

        $id = Input::get('menu_id');

        $respuesta = Menu::pasarSeccionesACategoria($id);
        if (Request::ajax()) {
            return Response::json(['mensaje' => $respuesta['mensaje'], 'error' => $respuesta['error'], 'url' => '../']);
        } else {
            if ($respuesta['error'] == true) {
                return Redirect::to('admin/seccion')->withErrors($respuesta['mensaje'])->withInput();
            } else {
                return Redirect::to('admin/categoria')->with('mensaje', $respuesta['mensaje']);
            }
        }
    }

    public function vistaOrdenar() {
        return View::make('menu.ordenar-menu-popup', $this->array_view);
    }

    public function ordenar() {

        foreach (Input::get('orden') as $key => $menu_id) {
            $respuesta = Menu::ordenar($menu_id, $key);
        }

        return Redirect::to('admin/menu');
    }

    public function vistaOrdenarSubmenu($menu_id) {
        $menu = Menu::find($menu_id);

        $menus_ordenar = $menu->children;

        $this->array_view['menu_id'] = $menu_id;
        $this->array_view['menus_ordenar'] = $menus_ordenar;

        return View::make('menu.ordenar-submenu-popup', $this->array_view);
    }

    public function ordenarSubmenu() {

        foreach (Input::get('orden') as $key => $menu_id) {
            $respuesta = Menu::ordenarSubmenu($menu_id, $key, Input::get('menu_id'));
        }

        return Redirect::to('admin/menu');
    }

}
