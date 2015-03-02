<?php

class HomeController extends BaseController {

    public function inicio() {

        $items_destacados = parent::itemsDestacados();
        $slideIndex = parent::slideIndex();
        if (count($items_destacados) < 5) {
            if (count($items_destacados) > 0) {
                $destacados = array();
                foreach ($items_destacados as $item) {
                    array_push($destacados, $item->id);
                }

                $ultimos_productos = Item::where('estado', 'A')->whereNotIn('id', $destacados)->orderBy('fecha_modificacion', 'desc')->skip(0)->take(5 - count($items_destacados))->get();
            } else {
                $ultimos_productos = Item::where('estado', 'A')->orderBy('fecha_modificacion', 'desc')->skip(0)->take(5 - count($items_destacados))->get();
            }
        } else {
            $ultimos_productos = NULL;
        }

        $this->array_view['items_destacados'] = $items_destacados;
        $this->array_view['slide_index'] = $slideIndex;
        $this->array_view['ultimos_productos'] = $ultimos_productos;

        return View::make($this->project_name . '-inicio', $this->array_view);
    }

    public function contacto() {
        
        return View::make($this->project_name . '-contacto', $this->array_view);
    }

    public function error() {

        $texto = Session::get('texto');

        $this->array_view['texto'] = $texto;

        return View::make($this->project_name . '-error', $this->array_view);
    }

    public function consultaContacto() {

        $data = Input::all();
        $this->array_view['data'] = $data;

        Mail::send('emails.consulta-contacto', $this->array_view, function($message) use($data) {
            $message->from($data['email'], $data['nombre'])
                    ->to('max.-ang@hotmail.com.ar')
                    ->subject('Consulta')
            ;
        });

        if (count(Mail::failures()) > 0) {
            $mensaje = 'El mail no pudo enviarse.';
        } else {
            $mensaje = 'El mail se envió correctamente';
        }

        if (isset($data['continue']) && ($data['continue'] != "")) {
            switch ($data['continue']) {
                case "contacto":
                    return Redirect::to('contacto')->with('mensaje', $mensaje);
                    break;
                case "menu":
                    $menu = Menu::find($data['menu_id']);

                    return Redirect::to('/' . $menu->url)->with('mensaje', $mensaje);
                    break;
            }
        }

        return Redirect::to("/")->with('mensaje', $mensaje);
        //return View::make('producto.editar', $this->array_view);
    }

}
