<?php

class BaseController extends Controller {

    protected $project_name = 'tatu';
    protected $array_view = array();

    public function __construct() {
        $this->array_view['project_name'] = $this->project_name;
        $this->array_view['menus'] = $this->desplegarMenu();
        $this->array_view['menu_estatico'] = $this->menuEstatico();
        $this->array_view['menu_dinamico'] = $this->menuDinamico();
        $this->array_view['slide_index'] = $this->slideIndex();
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    protected function desplegarMenu() {
        /*
         * FILTRO PARA MOSTRAR SOLAMENTE LOS MENU PADRE
         */
        $menus_asociados = DB::table('menu_asociado')->where('estado', 'A')->lists('menu_id_asociado');
        if ($menus_asociados) {
            $menus = Menu::where('estado', 'A')->whereNotIn('id', $menus_asociados)->orderBy('orden')->get();
        } else {
            $menus = Menu::where('estado', 'A')->orderBy('orden')->get();
        }

        return $menus;
    }

    protected function menuEstatico() {
        $menu_desplegado = $this->desplegarMenu();

        $menus = array();

        foreach ($menu_desplegado as $menu) {
            if (is_null($menu->categoria())) {
                array_push($menus, $menu);
            }
        }

        return $menus;
    }

    protected function menuDinamico() {
        $menu_desplegado = $this->desplegarMenu();

        $menus = array();

        foreach ($menu_desplegado as $menu) {
            if (!is_null($menu->categoria())) {
                array_push($menus, $menu);
            }
        }

        return $menus;
    }

    protected function desplegarCategoria() {
        /*
         * FILTRO PARA MOSTRAR SOLAMENTE LOS MENU PADRE
         */
        $categorias_asociadas = DB::table('categoria_asociada')->where('estado', 'A')->lists('categoria_id_asociada');

        if ($categorias_asociadas) {
            $categorias = Categoria::where('estado', 'A')->whereNotIn('id', $categorias_asociadas)->get();
        } else {
            $categorias = Categoria::where('estado', 'A')->get();
        }

        return $categorias;
    }

    protected function itemsDestacados() {
        /*
         * FILTRO PARA MOSTRAR SOLAMENTE LOS MENU PADRE
         */
        $items_destacados = DB::table('item')
                ->join('item_seccion', 'item.id', '=', 'item_seccion.item_id')
                ->join('seccion', 'item_seccion.seccion_id', '=', 'seccion.id')
                ->where('item.estado', 'A')
                ->where('item_seccion.estado', 'A')
                ->where('item_seccion.destacado', 'A')
                ->where('seccion.estado', 'A')
                ->orderBy('item.id', 'desc')
                ->limit(5)
                ->select('item.id as item_id', 'item.titulo as item_titulo', 'item.descripcion as item_descripcion', 'item.url as item_url', 'seccion.id as seccion_id')
                ->get();

        $items = $items_destacados;

        if ($items_destacados) {
            $items = array();
            foreach ($items_destacados as $item) {
                $item_db = Item::find($item->item_id);

                array_push($items, $item_db);
            }
        }

        return $items;
    }

    protected function slideIndex() {
        return Slide::where('estado', 'A')->where('tipo', 'I')->first();
    }

    protected function seccionesDinamicas() {
        $secciones_dinamicas = array();

        $secciones = Seccion::where('estado', 'A')->get();

        foreach ($secciones as $seccion) {
            if (!is_null($seccion->menuSeccion()->categoria())) {
                array_push($secciones_dinamicas, $seccion);
            }
        }

        return $secciones_dinamicas;
    }

    protected function seccionesEstaticas() {
        $secciones_estaticas = array();

        $secciones = Seccion::where('estado', 'A')->get();

        foreach ($secciones as $seccion) {
            if (is_null($seccion->menuSeccion()->categoria())) {
                array_push($secciones_estaticas, $seccion);
            }
        }

        return $secciones_estaticas;
    }
}
