<?php

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class Imagen extends Eloquent {

    //Tabla de la BD
    protected $table = 'imagen';
    //Atributos que van a ser modificables
    protected $fillable = array('nombre', 'epigrafe', 'carpeta', 'tipo', 'ampliada', 'estado', 'fecha_carga', 'fecha_modificacion', 'fecha_baja', 'usuario_id_carga', 'usuario_id_baja');
    //Hace que no se utilicen los default: create_at y update_at
    public $timestamps = false;

    public static function agregarImagen($imagen = null, $epigrafe = null, $coordenadas = null) {

        $respuesta = array();

        $datos = array(
            'imagen' => $imagen,
            'epigrafe' => $epigrafe
        );

        $rules = array(
            'imagen' => array('mimes:jpeg,png,gif'),
        );

        $validator = Validator::make($datos, $rules);

        if ($validator->fails()) {
            //return Response::make($validator->errors->first(), 400);
            //Si está todo mal, carga lo que corresponde en el mensaje.
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = 'no pasa';
        } else {


            $file = $imagen;

            $count = count($file->getClientOriginalName()) - 4;

            $filename = Str::limit(Str::slug($file->getClientOriginalName()), $count, "");
            $extension = $file->getClientOriginalExtension(); //if you need extension of the file
            //$extension = File::extension($file['name']);

            $carpeta = '/uploads/';
            $directory = public_path() . $carpeta;
            //$filename = sha1(time() . Hash::make($filename) . time()) . ".{$extension}";
            //Pregunto para que no se repita el nombre de la imagen
            if (!is_null(Imagen::imagenPorNombre($filename . ".{$extension}"))) {

                $filename = $filename . "(" . Str::limit(sha1(time()), 3, "") . ")" . ".{$extension}";
            } else {
                $filename = $filename . ".{$extension}";
            }

            //$upload_success = $file->move($directory, $filename);

            if (Image::make($file)->resize(490, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($directory . $filename)) {
                $datos = array(
                    'nombre' => $filename,
                    'epigrafe' => $epigrafe,
                    'carpeta' => $carpeta,
                    'tipo' => 'G',
                    'ampliada' => '',
                    'estado' => 'A',
                    'fecha_carga' => date("Y-m-d H:i:s"),
                    'usuario_id_carga' => Auth::user()->id
                );

                $imagen = static::create($datos);

                $temporary = Image::make($file)->resize(490, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save(public_path() . "/temporary/" . $filename);

                $imagen_chica = Imagen::agregarImagenChica($filename, $epigrafe, $imagen->id, $coordenadas);

                //Mensaje correspondiente a la agregacion exitosa
                $respuesta['mensaje'] = 'Imagen creada.';
                $respuesta['error'] = false;
                $respuesta['data'] = $imagen;
                //return Response::json('success', 200);
            } else {
                //Mensaje correspondiente a la agregacion exitosa
                $respuesta['mensaje'] = 'Imagen errónea.';
                $respuesta['error'] = true;
                $respuesta['data'] = null;
                //return Response::json('error', 400);
            }
        }

        return $respuesta;
    }

    public static function agregarImagenChica($imagen = null, $epigrafe = null, $imagen_ampliada, $coordenadas = null) {

        $respuesta = array();

        $rules = array(
                //'file' => 'image',
        );

        //$validator = Validator::make($imagen, $rules);
        //echo "HOLÑA -> " . $imagen->getRealPath();

        if (false) {//$validator->fails()) {
            //return Response::make($validation->errors->first(), 400);
            //Si está todo mal, carga lo que corresponde en el mensaje.
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = 'no pasa';
        } else {

            $file = $imagen;
            //$filename = $file->getClientOriginalName();
            //$extension = $file->getClientOriginalExtension(); //if you need extension of the file
            //$extension = File::extension($file['name']);

            $carpeta = '/uploads/';
            $directory = public_path() . $carpeta;
            $filename = "small_" . $imagen; //sha1(time() . Hash::make($filename) . time()) . "_small" . ".{$extension}";
            /*
              if (dd(is_readable($directory . $file))) {
              echo "Es";
              } else {
              echo "NO ES";
              }
             * 
             */
            if (!is_null($coordenadas)) {
                $w = round($coordenadas['w']);
                $h = round($coordenadas['h']);
                $x = round($coordenadas['x']);
                $y = round($coordenadas['y']);

                $upload = Image::make(public_path() . "/temporary/" . $file)->crop($w, $h, $x, $y)->resize(230, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($directory . $filename);
            } else {
                //para relacion height auto
                $upload = Image::make(public_path() . "/temporary/" . $file)->resize(230, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($directory . $filename);
                //para cuadrado
                //$upload = Image::make(public_path() . "/temporary/" . $file)->resize(340, 340)->save($directory . $filename);
            }

            if ($upload) {
                $datos = array(
                    'nombre' => $filename,
                    'epigrafe' => $epigrafe,
                    'carpeta' => $carpeta,
                    'tipo' => 'C',
                    'ampliada' => $imagen_ampliada,
                    'estado' => 'A',
                    'fecha_carga' => date("Y-m-d H:i:s"),
                    'usuario_id_carga' => Auth::user()->id
                );

                $imagen = static::create($datos);

                //Mensaje correspondiente a la agregacion exitosa
                $respuesta['mensaje'] = 'Imagen creada.';
                $respuesta['error'] = false;
                $respuesta['data'] = $imagen;
                //return Response::json('success', 200);
            } else {
                //Mensaje correspondiente a la agregacion exitosa
                $respuesta['mensaje'] = 'Imagen errónea.';
                $respuesta['error'] = true;
                $respuesta['data'] = null;
                //return Response::json('error', 400);
            }
        }

        return $respuesta;
    }

    public static function agregarImagenSlideHome($imagen = null, $epigrafe = null, $coordenadas = null) {

        $respuesta = array();

        $datos = array(
            'imagen' => $imagen,
            'epigrafe' => $epigrafe
        );

        $rules = array(
            'imagen' => array('mimes:jpeg,png,gif'),
        );

        $validator = Validator::make($datos, $rules);

        if ($validator->fails()) {
            //return Response::make($validator->errors->first(), 400);
            //Si está todo mal, carga lo que corresponde en el mensaje.
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = 'no pasa';
        } else {


            $file = $imagen;

            $count = count($file->getClientOriginalName()) - 4;

            $filename = Str::limit(Str::slug($file->getClientOriginalName()), $count, "");
            $extension = $file->getClientOriginalExtension(); //if you need extension of the file
            //$extension = File::extension($file['name']);

            $carpeta = '/uploads/';
            $directory = public_path() . $carpeta;
            //$filename = sha1(time() . Hash::make($filename) . time()) . ".{$extension}";
            //Pregunto para que no se repita el nombre de la imagen
            if (!is_null(Imagen::imagenPorNombre($filename . ".{$extension}"))) {

                $filename = $filename . "(" . Str::limit(sha1(time()), 3, "") . ")" . ".{$extension}";
            } else {
                $filename = $filename . ".{$extension}";
            }

            //$upload_success = $file->move($directory, $filename);

            if (Image::make($file)->resize(2000, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($directory . $filename)) {
                $datos = array(
                    'nombre' => $filename,
                    'epigrafe' => $epigrafe,
                    'carpeta' => $carpeta,
                    'tipo' => 'G',
                    'ampliada' => '',
                    'estado' => 'A',
                    'fecha_carga' => date("Y-m-d H:i:s"),
                    'usuario_id_carga' => Auth::user()->id
                );

                $imagen = static::create($datos);

                //Mensaje correspondiente a la agregacion exitosa
                $respuesta['mensaje'] = 'Imagen creada.';
                $respuesta['error'] = false;
                $respuesta['data'] = $imagen;
                //return Response::json('success', 200);
            } else {
                //Mensaje correspondiente a la agregacion exitosa
                $respuesta['mensaje'] = 'Imagen errónea.';
                $respuesta['error'] = true;
                $respuesta['data'] = null;
                //return Response::json('error', 400);
            }
        }

        return $respuesta;
    }

    public static function editar($input) {
        $respuesta = array();

        $reglas = array(
            'id' => array('integer')
        );

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            $imagen = Imagen::find($input['id']);

            $imagen->epigrafe = $input['epigrafe'];
            $imagen->fecha_modificacion = date("Y-m-d H:i:s");

            $imagen->save();

            if ($imagen->ampliada != 0) {
                $datos = array(
                    'id' => $imagen->ampliada,
                    'epigrafe' => $imagen->epigrafe
                );
                $imagen = Imagen::editar($datos);
            }

            $respuesta['mensaje'] = 'Imagen modificada.';
            $respuesta['error'] = false;
            $respuesta['data'] = $imagen;
        }

        return $respuesta;
    }

    public static function borrar($input) {
        $respuesta = array();

        $reglas = array(
            'id' => array('integer')
        );

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            $imagen = Imagen::find($input['id']);

            $imagen->fecha_baja = date("Y-m-d H:i:s");
            $imagen->estado = 'B';
            $imagen->usuario_id_baja = Auth::user()->id;

            $imagen->save();

            if ($imagen->ampliada != 0) {
                $datos = array(
                    'id' => $imagen->ampliada
                );
                $imagen = Imagen::borrar($datos);
            }

            $respuesta['mensaje'] = 'Imagen eliminada.';
            $respuesta['error'] = false;
            $respuesta['data'] = $imagen;
        }

        return $respuesta;
    }

    public function miniatura() {
        return DB::table('imagen')
                        ->where('tipo', 'C')
                        ->where('ampliada', $this->id)
                        ->where('estado', 'A')
                        ->first();
    }

    public function ampliada() {
        return DB::table('imagen')
                        ->where('tipo', 'G')
                        ->where('id', $this->ampliada)
                        ->where('estado', 'A')
                        ->first();
    }

    //Me quedo con las categorias a las que pertenece el Item
    public function items() {
        return $this->belongsToMany('Item', 'item_imagen', 'item_id', 'imagen_id');
    }

    //Me quedo con las secciones a las que pertenece el Item
    public function slides() {
        return $this->belongsToMany('Slide', 'slide_imagen', 'slide_id', 'imagen_id');
    }

    public static function imagenPorNombre($nombre) {
        return DB::table('imagen')
                        ->where('nombre', $nombre)
                        ->first();
    }

}
