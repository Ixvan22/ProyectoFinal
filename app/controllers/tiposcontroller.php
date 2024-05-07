<?php

namespace app\controllers;
use app\models\mainModel;

class tiposController extends mainModel {
    public function listarCargosControlador():string {
        $contenido = '<select class="form-select w-75" id="trabajador-cargo" name="trabajador-cargo" autocomplete="none">
        <option selected value="default"></option>';

        $consultaCargo = 'SELECT * FROM tipo_cargo ORDER BY tipo';
        $consultaCargo = $this->ejecutarConsulta($consultaCargo);

        while ($result = $consultaCargo->fetch(\PDO::FETCH_ASSOC)) {
            $contenido .= '<option value="'.$result["tipo"].'">'.ucfirst(mb_strtolower($result["nombre"])).'</option>';
        }
        $contenido .= '</select>';

        return $contenido;
    }

    public function listarPesosControlador():string {
        $contenido = '<select class="form-select w-25" name="tipo-peso" id="tipo-peso">';

        $consultaPeso = 'SELECT * FROM tipo_peso ORDER BY tipo';
        $consultaPeso = $this->ejecutarConsulta($consultaPeso);

        while ($result = $consultaPeso->fetch(\PDO::FETCH_ASSOC)) {
            $contenido .= '<option value="'.$result["tipo"].'">'.mb_strtoupper($result["nombre"]).'</option>';
        }
        $contenido .= '</select>';

        return $contenido;
    }
}


?>