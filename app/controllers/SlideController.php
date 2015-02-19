<?php

class SlideController extends BaseController {

    public function vistaAgregar($menu_id, $tipo) {
        $datos = array(
            'titulo' => '',
            'menu_id' => $menu_id
        );

        $seccion = Seccion::agregarSeccion($datos);
        
        $this->array_view['seccion_id'] = $seccion['data']->id;
        $this->array_view['tipo'] = $tipo;

        return View::make('slide.agregar', $this->array_view);
    }

    public function agregar() {

        //Aca se manda a la funcion agregarItem de la clase Item
        //y se queda con la respuesta para redirigir cual sea el caso
        $respuesta = Slide::agregarSlide(Input::all());

        if ($respuesta['error'] == true) {
            return Redirect::to('admin/item')->withErrors($respuesta['mensaje'])->withInput();
        } else {
            $menu = $respuesta['data']->seccion->menuSeccion()->url;
            $ancla = '#' . $respuesta['data']->seccion->estado . $respuesta['data']->seccion->id;

            return Redirect::to('menu/' . $menu)->with('mensaje', $respuesta['mensaje'])->with('ancla', $ancla);
        }
    }

}
