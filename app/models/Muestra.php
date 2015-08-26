<?php

class Muestra extends Item {

    //Tabla de la BD
    protected $table = 'muestra';
    //Atributos que van a ser modificables
    protected $fillable = array('item_id', 'cuerpo');
    //Hace que no se utilicen los default: create_at y update_at
    public $timestamps = false;

    //Función de Agregación de Item
    public static function agregar($input) {
        //Lo crea definitivamente

        $ok = false;
        if (isset($input['video']) && ($input['video'] != "")) {
            if (is_array($input['video'])) {
                foreach ($input['video'] as $key => $video) {
                    if ($video != "") {

                        $dataUrl = parse_url($video);

                        if (in_array($dataUrl['host'], ['vimeo.com', 'www.vimeo.com'])) {
                            $hosts = array('vimeo.com', 'www.vimeo.com');

                            if (Video::validarUrlVimeo($video, $hosts)['estado']) {
                                $ok = true;
                            }
                        } else {
                            $hosts = array('youtube.com', 'www.youtube.com');
                            $paths = array('/watch');

                            if (Video::validarUrl($video, $hosts, $paths)['estado']) {
                                if ($ID_video = Youtube::parseVIdFromURL($video)) {
                                    $ok = true;
                                }
                            }
                        }
                    } else {
                        $ok = true;
                        break;
                    }
                }
            } else {
                $dataUrl = parse_url($input['video']);

                if (in_array($dataUrl['host'], ['vimeo.com', 'www.vimeo.com'])) {
                    $hosts = array('vimeo.com', 'www.vimeo.com');

                    if (Video::validarUrlVimeo($input['video'], $hosts)['estado']) {
                        $ok = true;
                    }
                } else {
                    $hosts = array('youtube.com', 'www.youtube.com');
                    $paths = array('/watch');

                    if (Video::validarUrl($input['video'], $hosts, $paths)['estado']) {
                        if ($ID_video = Youtube::parseVIdFromURL($input['video'])) {
                            $ok = true;
                        }
                    }
                }
            }
        } else {
            $ok = true;
        }

        if ($ok) {

            if (isset($input['descripcion'])) {

                $input['descripcion'] = $input['descripcion'];
            } else {
                $input['descripcion'] = NULL;
            }


            $item = Item::agregarItem($input);

            if (isset($input['cuerpo'])) {

                $cuerpo = $input['cuerpo'];
            } else {
                $cuerpo = NULL;
            }

            if (!$item['error']) {

                $muestra = static::create(['item_id' => $item['data']->id, 'cuerpo' => $cuerpo]);

                $respuesta['data'] = $muestra;
                $respuesta['error'] = false;
                $respuesta['mensaje'] = "Muestra creada.";
            } else {
                $respuesta['error'] = true;
                $respuesta['mensaje'] = "La muestra no pudo ser creada. Compruebe los campos.";
            }
        } else {
            $respuesta['error'] = true;
            $respuesta['mensaje'] = "Problema en la/s url de video cargada.";
        }
        return $respuesta;
    }

    public static function editar($input) {
        $ok = false;
        if (isset($input['video']) && ($input['video'] != "")) {
            if (is_array($input['video'])) {
                foreach ($input['video'] as $key => $video) {
                    if ($video != "") {

                        $dataUrl = parse_url($video);

                        if (in_array($dataUrl['host'], ['vimeo.com', 'www.vimeo.com'])) {
                            $hosts = array('vimeo.com', 'www.vimeo.com');

                            if (Video::validarUrlVimeo($video, $hosts)['estado']) {
                                $ok = true;
                            }
                        } else {
                            $hosts = array('youtube.com', 'www.youtube.com');
                            $paths = array('/watch');

                            if (Video::validarUrl($video, $hosts, $paths)['estado']) {
                                if ($ID_video = Youtube::parseVIdFromURL($video)) {
                                    $ok = true;
                                }
                            }
                        }
                    } else {
                        $ok = true;
                        break;
                    }
                }
            } else {
                $dataUrl = parse_url($input['video']);

                if (in_array($dataUrl['host'], ['vimeo.com', 'www.vimeo.com'])) {
                    $hosts = array('vimeo.com', 'www.vimeo.com');

                    if (Video::validarUrlVimeo($input['video'], $hosts)['estado']) {
                        $ok = true;
                    }
                } else {
                    $hosts = array('youtube.com', 'www.youtube.com');

                    $paths = array('/watch');

                    if (Video::

                            validarUrl($input['video'], $hosts, $paths)['estado']) {
                        if ($ID_video = Youtube::parseVIdFromURL($input['video'])) {
                            $ok = true;
                        }
                    }
                }
            }
        } else {
            $ok = true;
        }

        if ($ok) {
            $respuesta = array();

            $reglas = array(
                'titulo' => array('required', 'max:50', 'unique:item,titulo,' . $input['id']),
            );

            $validator = Validator::make($input, $reglas);

            if ($validator->fails()) {
                $respuesta['mensaje'] = $validator->messages()->first('titulo');
                $respuesta['error'] = true;
            } else {

                $muestra = Muestra::find($input['muestra_id']);

                if (isset($input['cuerpo'])) {

                    $cuerpo = $input['cuerpo'];
                } else {
                    $cuerpo = NULL;
                }

                $muestra->cuerpo = $cuerpo;

                $muestra->save();

                if (isset($input['descripcion'])) {

                    $input['descripcion'] = $input['descripcion'];
                } else {
                    $input['descripcion'] = NULL;
                }

                $item = Item::editarItem($input);

                $respuesta['mensaje'] = 'Muestra modificada.';
                $respuesta['error'] = false;
                $respuesta['data'] = $muestra;
            }
        } else {
            $respuesta['error'] = true;
            $respuesta['mensaje'] = "Problema en la/s url de video cargada.";
        }
        return $respuesta;
    }

    public function item() {
        return Item::find($this->item_id);
    }

    public static function buscar($item_id) {
        return Portfolio::where('item_id', $item_id)->first();
    }

}
