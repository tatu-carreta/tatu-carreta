<?php

class Portfolio extends Item {

    //Tabla de la BD
    protected $table = 'portfolio_simple';
    //Atributos que van a ser modificables
    protected $fillable = array('item_id');
    //Hace que no se utilicen los default: create_at y update_at
    public $timestamps = false;

    //Función de Agregación de Item
    public static function agregar($input) {
        //Lo crea definitivamente

        if (isset($input['descripcion'])) {

            $input['descripcion'] = $input['descripcion'];
        } else {
            $input['descripcion'] = NULL;
        }


        $item = Item::agregarItem($input);

        $portfolio_simple = static::create(['item_id' => $item['data']->id]);

        if ($portfolio_simple) {
            $respuesta['error'] = false;
            $respuesta['mensaje'] = "Portfolio creado.";
            $respuesta['data'] = $portfolio_simple;
        } else {
            $respuesta['error'] = true;
            $respuesta['mensaje'] = "Error en el portfolio. Compruebe los campos.";
        }

        return $respuesta;
    }

    public static function editar($input) {
        $respuesta = array();

        $reglas = array(
        );

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            $portfolio_simple = Portfolio::find($input['portfolio_id']);

            $portfolio_simple->save();

            if (isset($input['descripcion'])) {

                $input['descripcion'] = $input['descripcion'];
            } else {
                $input['descripcion'] = NULL;
            }

            $item = Item::editarItem($input);

            $respuesta['mensaje'] = 'Portfolio modificado.';
            $respuesta['error'] = false;
            $respuesta['data'] = $portfolio_simple;
        }

        return $respuesta;
    }

    public function item() {
        return Item::find($this->item_id);
    }

    public function portfolio_completo() {
        return PortfolioCompleto::where('portfolio_simple_id', $this->id)->first();
    }
    
    public static function buscar($item_id) {
        return Portfolio::where('item_id', $item_id)->first();
    }

}
