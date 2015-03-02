<?php

class CarritoController extends BaseController {

    public function vistaListado() {

        //Hace que se muestre el html lista.blade.php de la carpeta categoria
        //con los parametros pasados por el array
        return View::make('carrito.' . $this->project_name . '-ver', $this->array_view);
    }

    public function agregarProducto($producto_id) {

        $info = array(
            'producto_id' => $producto_id
        );

        //Aca se manda a la funcion borrarItem de la clase Item
        //y se queda con la respuesta para redirigir cual sea el caso
        $respuesta = Carrito::agregarProducto($info);

        $producto = Producto::find($producto_id);

        $menu = $producto->item()->seccionItem()->menuSeccion()->url;
        $ancla = '#' . $producto->item()->seccionItem()->estado . $producto->item()->seccionItem()->id;
        
        return Redirect::to('/' . $menu)->with('mensaje', $respuesta['mensaje'])->with('ancla', $ancla);
        //return $respuesta;
    }

    public function editarProducto($producto_id, $rowId) {

        $info = array(
            'producto_id' => $producto_id,
            'rowId' => $rowId
        );

        //Aca se manda a la funcion borrarItem de la clase Item
        //y se queda con la respuesta para redirigir cual sea el caso
        $respuesta = Carrito::editarProducto($info);

        return $respuesta;
    }

    public function borrarProducto($producto_id, $rowId) {

        $info = array(
            'producto_id' => $producto_id,
            'rowId' => $rowId
        );

        //Aca se manda a la funcion borrarItem de la clase Item
        //y se queda con la respuesta para redirigir cual sea el caso
        $respuesta = Carrito::borrarProducto($info);

        return Redirect::to('/carrito')->with('mensaje', $respuesta['mensaje']);
    }
    
    public function borrar() {

        //Aca se manda a la funcion borrarItem de la clase Item
        //y se queda con la respuesta para redirigir cual sea el caso
        $respuesta = Carrito::borrar();

        return Redirect::to('/carrito')->with('mensaje', $respuesta['mensaje']);
    }

}
