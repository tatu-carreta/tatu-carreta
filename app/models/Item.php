<?php

class Item extends Eloquent {

    //Tabla de la BD
    protected $table = 'item';
    //Atributos que van a ser modificables
    protected $fillable = array('titulo', 'descripcion', 'url', 'estado', 'fecha_carga', 'fecha_modificacion', 'fecha_baja', 'usuario_id_carga', 'usuario_id_baja');
    //Hace que no se utilicen los default: create_at y update_at
    public $timestamps = false;

    //Función de Agregación de Item
    public static function agregarItem($input) {

        $respuesta = array();

        //Se definen las reglas con las que se van a validar los datos..
        $reglas = array(
            'titulo' => array('max:50', 'unique:item'),
            'seccion_id' => array('integer'),
        );

        if (isset($input['file']) && ($input['file'] != "") && (!is_array($input['file']))) {
            $reglas['x'] = array('required');
            $reglas['y'] = array('required');
            $reglas['h'] = array('required');
            $reglas['w'] = array('required');
        }

        //Se realiza la validación
        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            // $respuesta['mensaje'] = "No se pudo realizar la carga del producto. Compruebe los campos.";
            $respuesta['mensaje'] = $validator->messages()->first('titulo');
            //Si está todo mal, carga lo que corresponde en el mensaje.

            $respuesta['error'] = true;
        } else {

            if ($input['titulo'] == "") {
                $max_id = DB::table('item')->max('id');
                $ultimo_id = $max_id + 1;
                $url = 'item-' . $ultimo_id;
            } else {
                $url = $input['titulo'];
            }

            //Se cargan los datos necesarios para la creacion del Item
            $datos = array(
                'titulo' => $input['titulo'],
                'descripcion' => $input['descripcion'],
                'url' => Str::slug($url),
                'estado' => 'A',
                'fecha_carga' => date("Y-m-d H:i:s"),
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'usuario_id_carga' => Auth::user()->id
            );

            //Lo crea definitivamente
            $item = static::create($datos);

            if (isset($input['file']) && ($input['file'] != "")) {
                if (is_array($input['file'])) {
                    foreach ($input['file'] as $key => $imagen) {
                        if ($imagen != "") {
                            $imagen_creada = Imagen::agregarImagen($imagen, $input['epigrafe'][$key]);

                            if (!$imagen_creada['error']) {
                                if (isset($input['destacado']) && ($input['destacado'] == $key)) {
                                    $destacado = array(
                                        "destacado" => "A"
                                    );
                                } else {
                                    $destacado = array(
                                        "destacado" => NULL
                                    );
                                }
                                $item->imagenes()->attach($imagen_creada['data']->miniatura()->id, $destacado);
                            }
                        }
                    }
                } else {
                    $coordenadas = array("x" => $input['x'], "y" => $input['y'], "w" => $input['w'], "h" => $input['h']);
                    $imagen_creada = Imagen::agregarImagen($input['file'], $input['epigrafe_imagen_portada'], $coordenadas);

                    $item->imagenes()->attach($imagen_creada['data']->miniatura()->id, array("destacado" => "A"));
                }
            }

            if (isset($input['archivo']) && ($input['archivo'] != "")) {
                if (is_array($input['archivo'])) {
                    foreach ($input['archivo'] as $key => $archivo) {
                        if ($archivo != "") {
                            $data_archivo = array(
                                'archivo' => $archivo,
                                    //'titulo' => $input['titulo_archivo'][$key]
                            );
                            $archivo_creado = Archivo::agregar($data_archivo);

                            $item->archivos()->attach($archivo_creado['data']->id);
                        }
                    }
                } else {
                    $data_archivo = array(
                        'archivo' => $input['archivo'],
                            //'titulo' => $input['titulo_archivo']
                    );
                    $archivo_creado = Archivo::agregar($data_archivo);
                    $item->archivos()->attach($archivo_creado['data']->id);
                    //$item->imagenes()->attach($imagen_creada['data']->miniatura()->id, array("destacado" => "A"));
                }
            }

            if (isset($input['imagen_portada']) && ($input['imagen_portada'] != "")) {

                if (isset($input['epigrafe_imagen_portada']) && ($input['epigrafe_imagen_portada'] != "")) {
                    $epigrafe_imagen_portada = $input['epigrafe_imagen_portada'];
                } else {
                    $epigrafe_imagen_portada = NULL;
                }

                $imagen_creada = Imagen::agregarImagen($input['imagen_portada'], $epigrafe_imagen_portada);

                $item->imagenes()->attach($imagen_creada['data']->miniatura()->id, array("destacado" => "A"));
            }
            //Le asocia la categoria en caso que se haya elegido alguna
            if (isset($input['categoria_id']) && ($input['categoria_id'] != "")) {
                $item->categorias()->attach($input['categoria_id']);
            }

            //Le asocia la seccion y por lo tanto la categoria correspondiente
            if ($input['seccion_id'] != "") {

                if (isset($input['item_destacado']) && ($input['item_destacado'] == 'A')) {
                    $destacado = 'A';
                } else {
                    $destacado = NULL;
                }

                $info = array(
                    'estado' => 'A',
                    'destacado' => $destacado
                );

                $item->secciones()->attach($input['seccion_id'], $info);

                //ME QUEDO CON LA SECCION CORRESPONDIENTE

                $seccion = Seccion::find($input['seccion_id']);

                //ME QUEDO CON EL MENU AL CUAL PERTENECE LA SECCION

                foreach ($seccion->menu as $menu) {
                    $menu_id = $menu->id;
                }

                $menu = Menu::find($menu_id);

                //ME QUEDO CON LA CATEGORIA AL CUAL PERTENECE EL MENU
                foreach ($menu->categorias as $categoria) {
                    $categoria_id = $categoria->id;
                }

                //IMPACTO AL ITEM CON LA CATEGORIA CORRESPONDIENTE

                if (isset($categoria_id)) {
                    $item->categorias()->attach($categoria_id);
                }
            }

            //Mensaje correspondiente a la agregacion exitosa
            $respuesta['mensaje'] = 'Producto creado.';
            $respuesta['error'] = false;
            $respuesta['data'] = $item;
        }

        return $respuesta;
    }

    public static function editarItem($input) {
        $respuesta = array();

        $reglas = array(
            'titulo' => array('max:50', 'unique:item,titulo,' . $input['id']),
        );

        if (isset($input['file']) && ($input['file'] != "") && (!is_array($input['file']))) {
            $reglas['x'] = array('required');
            $reglas['y'] = array('required');
            $reglas['h'] = array('required');
            $reglas['w'] = array('required');
        }

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator->messages()->first('titulo');
            $respuesta['error'] = true;
        } else {

            $item = Item::find($input['id']);

            $item_anterior = array(
                'item_id' => $item->id,
                'titulo' => $item->titulo,
                'descripcion' => $item->descripcion,
                'url' => $item->url,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'usuario_id' => Auth::user()->id
            );

            if ($input['titulo'] == "") {
                $url = $item->url;
            } else {
                $url = Str::slug($input['titulo']);
            }

            $item->titulo = $input['titulo'];
            $item->descripcion = $input['descripcion'];
            $item->url = $url;
            $item->fecha_modificacion = date("Y-m-d H:i:s");

            $item->save();

            $item_modificacion = DB::table('item_modificacion')->insert($item_anterior);

            if (isset($input['file']) && ($input['file'] != "")) {
                if (is_array($input['file'])) {
                    foreach ($input['file'] as $key => $imagen) {
                        if ($imagen != "") {
                            $imagen_creada = Imagen::agregarImagen($imagen, $input['epigrafe'][$key]);

                            if (!$imagen_creada['error']) {
                                if (isset($input['destacado']) && ($input['destacado'] == $key)) {
                                    $destacado = array(
                                        "destacado" => "A"
                                    );
                                } else {
                                    $destacado = array(
                                        "destacado" => NULL
                                    );
                                }
                                $item->imagenes()->attach($imagen_creada['data']->miniatura()->id, $destacado);
                            }
                        }
                    }
                } else {
                    $coordenadas = array("x" => $input['x'], "y" => $input['y'], "w" => $input['w'], "h" => $input['h']);
                    $imagen_creada = Imagen::agregarImagen($input['file'], $input['epigrafe'], $coordenadas);

                    $item->imagenes()->attach($imagen_creada['data']->miniatura()->id, array("destacado" => "A"));
                    //$item->imagenes()->attach($imagen_creada['data']->->id, array("destacado" => "A"));
                }
            }

            if (isset($input['archivo']) && ($input['archivo'] != "")) {
                if (is_array($input['archivo'])) {
                    foreach ($input['archivo'] as $key => $archivo) {
                        if ($archivo != "") {
                            $data_archivo = array(
                                'archivo' => $archivo,
                                    //'titulo' => $input['titulo_archivo'][$key]
                            );
                            $archivo_creado = Archivo::agregar($data_archivo);

                            $item->archivos()->attach($archivo_creado['data']->id);
                        }
                    }
                } else {
                    $data_archivo = array(
                        'archivo' => $input['archivo'],
                            //'titulo' => $input['titulo_archivo']
                    );
                    $archivo_creado = Archivo::agregar($data_archivo);
                    $item->archivos()->attach($archivo_creado['data']->id);
                    //$item->imagenes()->attach($imagen_creada['data']->miniatura()->id, array("destacado" => "A"));
                }
            }

            if (isset($input['imagen_id']) && ($input['imagen_id'] != "")) {
                $data_imagen = array(
                    'id' => $input['imagen_id'],
                    'epigrafe' => $input['epigrafe']
                );

                $imagen_editada = Imagen::editar($data_imagen);
            }

            if (isset($input['imagen_portada_editar']) && ($input['imagen_portada_editar'] != "")) {
                $data_imagen = array(
                    'id' => $input['imagen_portada_editar'],
                    'epigrafe' => $input['epigrafe_imagen_portada_editar']
                );

                $imagen_editada = Imagen::editar($data_imagen);
            }

            if (isset($input['imagen_portada']) && ($input['imagen_portada'] != "")) {
                $imagen_creada = Imagen::agregarImagen($input['imagen_portada']);

                $item->imagenes()->attach($imagen_creada['data']->miniatura()->id, array("destacado" => "A"));
            }

            if (isset($input['imagenes_editar']) && ($input['imagenes_editar'] != "")) {
                foreach ($input['imagenes_editar'] as $key => $imagen) {
                    if ($imagen != "") {

                        $datos = array(
                            'id' => $imagen,
                            'epigrafe' => $input['epigrafe_imagen_editar'][$key]
                        );

                        $imagen_modificada = Imagen::editar($datos);
                    }
                }
            }

            if (isset($input['seccion_nueva_id']) && ($input['seccion_nueva_id'] != "")) {
                if ($item->seccionItem()->id != $input['seccion_nueva_id']) {
                    $data_borrar = array(
                        'item_id' => $item->id,
                        'seccion_id' => $item->seccionItem()->id
                    );
                    $item->borrarItemSeccion($data_borrar);

                    $item->secciones()->attach($input['seccion_nueva_id'], array('estado' => 'A'));
                }
            }

            if (isset($input['item_destacado']) && ($input['item_destacado'] != "")) {
                $data_item = array(
                    'item_id' => $item->id,
                    'seccion_id' => $item->seccionItem()->id
                );

                if ($input['item_destacado'] == "A") {
                    $destacado = 'A';
                } else {
                    $destacado = NULL;
                }

                DB::table('item_seccion')->where($data_item)->update(['destacado' => $destacado]);
            } else {
                $data_item = array(
                    'item_id' => $item->id,
                    'seccion_id' => $item->seccionItem()->id
                );
                DB::table('item_seccion')->where($data_item)->update(['destacado' => NULL]);
            }

            $respuesta['mensaje'] = 'Producto modificado.';
            $respuesta['error'] = false;
            $respuesta['data'] = $item;
        }

        return $respuesta;
    }

    public static function borrarItem($input) {
        $respuesta = array();

        $reglas = array('id' => array('integer')
        );

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta ['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            $item = Item::find($input['id']);

            $item->fecha_baja = date("Y-m-d H:i:s");
            $item->titulo = $item->titulo . "-borrado";
            $item->url = $item->url . "-borrado";
            $item->estado = 'B';
            $item->usuario_id_baja = Auth::user()->id;

            $item->save();

            $respuesta['mensaje'] = 'Producto eliminado';
            $respuesta['error'] = false;
            $respuesta['data'] = $item;
        }

        return $respuesta;
    }

    public static function borrarItemSeccion($input) {
        $respuesta = array();

        $reglas = array(
            'item_id' => array('integer'),
            'seccion_id' => array('integer')
        );

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            $baja_item_seccion = DB::table('item_seccion')->where($input)->update(array(
                'estado' => 'B'));

            $respuesta['mensaje'] = 'Producto eliminado.';
            $respuesta['error'] = false;
            $respuesta['data'] = $baja_item_seccion;
        }

        return $respuesta;
    }

    public static function ordenarItemSeccion($item_id, $orden, $seccion_id) {
        $respuesta = array();

        $datos = array(
            'item_id' => $item_id,
            'orden' => $orden,
            'seccion_id' => $seccion_id
        );

        $reglas = array('item_id' => array('integer'),
            'orden' => array('integer'),
            'seccion_id' => array('integer')
        );

        $validator = Validator::make($datos, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {


            $input = array(
                'item_id' => $item_id,
                'seccion_id' => $seccion_id
            );

            $item = DB::table('item_seccion')->where(
                            $input)->update(array('orden' => $orden));

            $respuesta['mensaje'] = 'Los productos han sido ordenados.';
            $respuesta['error'] = false;
            $respuesta['data'] = $item;
        }

        return $respuesta;
    }

    public static function destacar($input) {
        $respuesta = array();

        $reglas = array(
            'item_id' => array('integer'),
            'seccion_id' => array('integer')
        );

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            $baja_item_seccion = DB::table('item_seccion')->where($input)->update(array(
                'destacado' => 'A'));

            $respuesta['mensaje'] = 'Producto destacado.';
            $respuesta['error'] = false;
            $respuesta['data'] = $baja_item_seccion;
        }

        return $respuesta;
    }

    public static function quitarDestacado($input) {
        $respuesta = array();

        $reglas = array('item_id' => array('integer'),
            'seccion_id' => array('integer')
        );

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            $baja_item_seccion = DB::table('item_seccion')->where($input)->update(array('destacado' =>
                NULL));

            $respuesta['mensaje'] = '';
            $respuesta['error'] = false;
            $respuesta['data'] = $baja_item_seccion;
        }

        return $respuesta;
    }

    public function seccionItem() {
        $seccion = NULL;
        foreach ($this->secciones as $secciones) {
            $seccion = $secciones;
        }

        return $seccion;
    }

    //Me quedo con las categorias a las que pertenece el Item
    public function categorias() {
        return $this->belongsToMany('Categoria', 'item_categoria', 'item_id', 'categoria_id');
    }

    //Me quedo con las secciones a las que pertenece el Item
    public function secciones() {
        return $this->belongsToMany('Seccion', 'item_seccion', 'item_id', 'seccion_id');
    }

    public function imagenes() {
        return $this->belongsToMany('Imagen', 'item_imagen', 'item_id', 'imagen_id')->where('imagen.estado', 'A')->whereNull('item_imagen.destacado')->orWhere('item_imagen.destacado', '<>', 'A');
    }

    public function imagenes_producto() {
        return $this->belongsToMany('Imagen', 'item_imagen', 'item_id', 'imagen_id')->where('imagen.estado', 'A')->orderBy('item_imagen.destacado', 'DESC')->get();
    }

    public function imagenes_producto_editar() {
        return $this->belongsToMany('Imagen', 'item_imagen', 'item_id', 'imagen_id')->where('imagen.estado', 'A')->whereNull('item_imagen.destacado')->orWhere('item_imagen.destacado', '<>', 'A')->get();
    }

    public function archivos() {
        return $this->belongsToMany('Archivo', 'item_archivo', 'item_id', 'archivo_id')->where('archivo.estado', 'A')->whereNull('item_archivo.destacado')->orWhere('item_archivo.destacado', '<>', 'A');
    }

    public function obtener_destacada() {
        return DB::table('item_imagen')
                        ->join('imagen', 'item_imagen.imagen_id', '=', 'imagen.id')
                        ->where('item_imagen.item_id', $this->id)
                        ->where('item_imagen.destacado', 'A')
                        ->where('imagen.estado', 'A')
                        ->get();
    }

    public function imagen_destacada() {
        $img = NULL;


        foreach ($this->obtener_destacada() as $image) {
            $img = Imagen::find($image->id);
        }

        return $img;
    }

    public function destacado() {
        if (DB::table('item_seccion')
                        ->join('seccion', 'item_seccion.seccion_id', '=', 'seccion.id')
                        ->join('item', 'item_seccion.item_id', '=', 'item.id')
                        ->where('item_seccion.estado', 'A')
                        ->where('item_seccion.item_id', $this->id)
                        ->where('item.estado', 'A')
                        ->where('seccion.estado', 'A')
                        ->where('item_seccion.destacado', 'A')
                        ->get()) {
            return true;
        }
        return false;
    }

    public function texto() {
        return Texto::where('item_id', $this->id)->first();
    }

    public function html() {
        return TextoHtml::where('item_id', $this->id)->first();
    }

    public function galeria() {
        return Galeria::where('item_id', $this->id)->first();
    }

    public function producto() {
        return Producto::where('item_id', $this->id)->first();
    }

    public function portfolio() {
        return Portfolio::where('item_id', $this->id)->first();
    }

}
