<?php

class Slide extends Eloquent {

    //Tabla de la BD
    protected $table = 'slide';
    //Atributos que van a ser modificables
    protected $fillable = array('seccion_id', 'tipo', 'estado', 'fecha_carga', 'fecha_modificacion', 'fecha_baja', 'usuario_id_carga', 'usuario_id_baja');
    //Hace que no se utilicen los default: create_at y update_at
    public $timestamps = false;

    //Función de Agregación de Slide
    public static function agregarSlide($input) {

        $respuesta = array();

        //Se definen las reglas con las que se van a validar los datos..
        $reglas = array(
            'seccion_id' => array('required'),
            'tipo' => array('required')
        );

        //Se realiza la validación
        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            //Si está todo mal, carga lo que corresponde en el mensaje.
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            //Se cargan los datos necesarios para la creacion del Item
            $datos = array(
                'seccion_id' => $input['seccion_id'],
                'tipo' => $input['tipo'],
                'estado' => 'A',
                'fecha_carga' => date("Y-m-d H:i:s"),
                'usuario_id_carga' => Auth::user()->id
            );

            //Lo crea definitivamente
            $slide = static::create($datos);

            if (isset($input['file']) && ($input['file'] != "")) {
                if (is_array($input['file'])) {
                    foreach ($input['file'] as $key => $imagen) {
                        if ($imagen != "") {
                            if ($input['tipo'] == "I") {
                                $imagen_creada = Imagen::agregarImagenSlideHome($imagen, $input['epigrafe'][$key]);
                            } else {
                                $imagen_creada = Imagen::agregarImagen($imagen, $input['epigrafe'][$key]);
                            }

                            if (!$imagen_creada['error']) {

                                $info = array(
                                    'estado' => 'A',
                                    'fecha_carga' => date("Y-m-d H:i:s"),
                                    'usuario_id_carga' => Auth::user()->id
                                );

                                $slide->imagenes()->attach($imagen_creada['data']->id, $info);
                            }
                        }
                    }
                }
            }

            //Mensaje correspondiente a la agregacion exitosa
            $respuesta['mensaje'] = 'Slide creado.';
            $respuesta['error'] = false;
            $respuesta['data'] = $slide;
        }

        return $respuesta;
    }

    //Me quedo con las categorias a las que pertenece el Item
    public function imagenes() {
        return $this->belongsToMany('Imagen', 'slide_imagen', 'slide_id', 'imagen_id');
    }

    //Me quedo con las secciones a las que pertenece el Item
    public function seccion() {
        return $this->belongsTo('Seccion', 'seccion_id');
    }

}
