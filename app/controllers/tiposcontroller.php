<?php

namespace app\controllers;
use app\models\mainModel;

class tiposController extends mainModel {
    public function listarCargosControlador():string {
        $contenido = '<select class="form-select w-75" id="nuevo-trabajador-cargo" name="nuevo-trabajador-cargo" autocomplete="none">
        <option selected value="default"></option>';

        $consultaCargo = 'SELECT * FROM tipo_cargo ORDER BY tipo';
        $consultaCargo = $this->ejecutarConsulta($consultaCargo);

        while ($result = $consultaCargo->fetch(\PDO::FETCH_ASSOC)) {
            $contenido .= '<option value="'.$result["tipo"].'">'.ucfirst(mb_strtolower($result["nombre"])).'</option>';
        }
        $contenido .= '</select>';

        return $contenido;
    }
}


?>