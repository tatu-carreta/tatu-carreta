<?php

class CategoriaController extends BaseController {

    public function vistaListado() {

        //Este arreglo es para seleccionar la categoria padre cuando estoy agregando una
        $this->array_view['categorias'] = parent::desplegarCategoria();

        //Hace que se muestre el html lista.blade.php de la carpeta categoria
        //con los parametros pasados por el array
        return View::make('categoria.lista', $this->array_view);
    }

    public function vistaAgregar() {

        $this->array_view['categorias'] = parent::desplegarCategoria();
        
        $modulos = Modulo::all();
        
        $this->array_view['modulos'] = $modulos;

        return View::make('categoria.crear', $this->array_view);
    }

    public function agregar() {

        //Aca se manda a la funcion agregarCategoria de la clase Categoria
        //y se queda con la respuesta para redirigir cual sea el caso
        $respuesta = Categoria::agregarCategoria(Input::all());

        if ($respuesta['error'] == true) {
            return Redirect::to('admin/menu')->withErrors($respuesta['mensaje'])->withInput();
        } else {
            return Redirect::to('admin/menu')->with('mensaje', $respuesta['mensaje']);
        }
    }

    public function mostrarInfoCategoria($url) {

        //Me quedo con la categoria, buscando por url
        $categoria = Categoria::where('url', $url)->first();

        $this->array_view['categoria'] = $categoria;

        return View::make('categoria.ver', $this->array_view);
    }

    public function vistaEditar($id) {

        //Me quedo con la categoria, buscando por id
        $categoria = Categoria::find($id);

        $categorias = Categoria::where('estado', 'A')->where('id', '<>', $id)->get();

        $this->array_view['categoria'] = $categoria;
        $this->array_view['categorias'] = $categorias;

        if ($categoria) {
            return View::make('categoria.editar', $this->array_view);
        } else {
            $this->array_view['texto'] = 'Página de Error!!';
            return View::make($this->project_name . '-error', $this->array_view);
        }
    }

    public function editar() {

        //Aca se manda a la funcion editarCategoria de la clase Categoria
        //y se queda con la respuesta para redirigir cual sea el caso
        $respuesta = Categoria::editarCategoria(Input::all());

        if ($respuesta['error'] == true) {
            return Redirect::to('admin/menu')->withErrors($respuesta['mensaje'])->withInput();
        } else {
            return Redirect::to('admin/menu')->with('mensaje', $respuesta['mensaje']);
        }
    }

    public function borrar() {

        //Aca se manda a la funcion borrarCategoria de la clase Categoria
        //y se queda con la respuesta para redirigir cual sea el caso
        $respuesta = Categoria::borrarCategoria(Input::all());

        return $respuesta;
    }

}