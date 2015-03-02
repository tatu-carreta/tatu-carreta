<?php

class TextoController extends BaseController {

    public function vistaAgregar($menu_id) {

        $datos = array(
            'titulo' => '',
            'menu_id' => $menu_id
        );

        $seccion = Seccion::agregarSeccion($datos);

        $this->array_view['seccion_id'] = $seccion['data']->id;

        return View::make('item.texto.agregar', $this->array_view);
    }

    public function agregar() {

        //Aca se manda a la funcion agregarItem de la clase Item
        //y se queda con la respuesta para redirigir cual sea el caso
        $respuesta = Texto::agregar(Input::all());

        if ($respuesta['error'] == true) {
            return Redirect::to('admin/item')->withErrors($respuesta['mensaje'])->withInput();
        } else {
            $menu = $respuesta['data']->item()->seccionItem()->menuSeccion()->url;
            $ancla = '#' . $respuesta['data']->item()->seccionItem()->estado . $respuesta['data']->item()->seccionItem()->id;

            return Redirect::to('/' . $menu)->with('mensaje', $respuesta['mensaje'])->with('ancla', $ancla);
        }
    }

    public function vistaEditar($id) {
        //Me quedo con el item, buscando por id
        $texto = Texto::buscar($id);
        if ($texto) {
            $this->array_view['item'] = $texto->item();
            $this->array_view['texto'] = $texto;
            return View::make('item.texto.editar-texto', $this->array_view);
        } else {
            $this->array_view['texto'] = 'Página de Error!!';
            return View::make($this->project_name . '-error', $this->array_view);
        }
    }

    public function editar() {
        //Aca se manda a la funcion editarItem de la clase Item
        //y se queda con la respuesta para redirigir cual sea el caso
        $respuesta = Texto::editar(Input::all());

        if ($respuesta['error'] == true) {
            return Redirect::to('admin/item')->withErrors($respuesta['mensaje'])->withInput();
        } else {
            $menu = $respuesta['data']->item()->seccionItem()->menuSeccion()->url;
            $ancla = '#' . $respuesta['data']->item()->seccionItem()->estado . $respuesta['data']->item()->seccionItem()->id;

            return Redirect::to('/' . $menu)->with('mensaje', $respuesta['mensaje'])->with('ancla', $ancla);
        }
    }

}