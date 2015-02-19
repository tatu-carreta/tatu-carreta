<?php

class PortfolioCompleto extends Texto {

    //Tabla de la BD
    protected $table = 'portfolio_completo';
    //Atributos que van a ser modificables
    protected $fillable = array('portfolio_simple_id', 'cuerpo');
    //Hace que no se utilicen los default: create_at y update_at
    public $timestamps = false;

    //Función de Agregación de Item
    public static function agregar($input) {


        //Lo crea definitivamente
        $portfolio_simple = Portfolio::agregar($input);

        if (isset($input['cuerpo'])) {

            $cuerpo = $input['cuerpo'];
        } else {
            $cuerpo = NULL;
        }

        if (!$portfolio_simple['error']) {

            $portfolio_completo = static::create(['portfolio_simple_id' => $portfolio_simple['data']->id, 'cuerpo' => $cuerpo]);

            $respuesta['data'] = $portfolio_completo;
            $respuesta['error'] = false;
            $respuesta['mensaje'] = "Portfolio creado.";
        } else {
            $respuesta['error'] = true;
            $respuesta['mensaje'] = "El portfolio no pudo ser creado. Compruebe los campos.";
        }


        return $respuesta;
    }

    public static function editar($input) {
        $respuesta = array();

        $reglas = array(
            'titulo' => array('required', 'max:50', 'unique:item,titulo,' . $input['id']),
        );

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator->messages()->first('titulo');
            $respuesta['error'] = true;
        } else {

            $portfolio_completo = PortfolioCompleto::find($input['portfolio_completo_id']);

            if (isset($input['cuerpo'])) {

                $cuerpo = $input['cuerpo'];
            } else {
                $cuerpo = NULL;
            }

            $portfolio_completo->cuerpo = $cuerpo;

            $portfolio_completo->save();

            $input['portfolio_id'] = $portfolio_completo->portfolio_simple_id;

            $portfolio_simple = Portfolio::editar($input);

            $respuesta['mensaje'] = 'Portfolio modificado.';
            $respuesta['error'] = false;
            $respuesta['data'] = $portfolio_completo;
        }

        return $respuesta;
    }

    public static function borrar($input) {
        $respuesta = array();

        $reglas = array(
        );

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            $item = Item::find($input['id']);

            $item->fecha_baja = date("Y-m-d H:i:s");
            $item->url = $item->url . "-borrado";
            $item->estado = 'B';
            $item->usuario_id_baja = Auth::user()->id;

            $item->save();

            $respuesta['mensaje'] = 'Portfolio eliminado.';
            $respuesta['error'] = false;
            $respuesta['data'] = $item;
        }

        return $respuesta;
    }

    public static function borrarItemSeccion($input) {
        $respuesta = array();

        $reglas = array(
        );

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            $baja_item_seccion = DB::table('item_seccion')->where($input)->update(array('estado' => 'B'));

            $respuesta['mensaje'] = 'Portfolio eliminado.';
            $respuesta['error'] = false;
            $respuesta['data'] = $baja_item_seccion;
        }

        return $respuesta;
    }

    public static function destacar($input) {
        $respuesta = array();

        $reglas = array();

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            $portfolio_completo = PortfolioCompleto::find($input['portfolio_completo_id']);

            $data = array(
                'item_id' => $portfolio_completo->portfolio_simple()->item()->id,
                'seccion_id' => $portfolio_completo->portfolio_simple()->item()->seccionItem()->id
            );

            $item = Item::destacar($data);

            $respuesta['mensaje'] = 'Portfolio destacado.';
            $respuesta['error'] = false;
            $respuesta['data'] = $portfolio_completo;
        }

        return $respuesta;
    }

    public function portfolio_simple() {
        return Portfolio::find($this->portfolio_simple_id);
    }

}
