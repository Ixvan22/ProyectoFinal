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

    public function listarMercanciaControlador():string{
        $contenido = '<select class="form-select w-75" name="mercancia-tipo-estado" id="mercancia-tipo-estado">
                        <option selected></option>';

        $consultaMercancia = 'SELECT * FROM tipo_estado_mercancia ORDER BY tipo';
        $consultaMercancia = $this->ejecutarConsulta($consultaMercancia);

        while ($result = $consultaMercancia->fetch(\PDO::FETCH_ASSOC)) {
            $contenido .= '<option value="'.$result["tipo"].'">'.ucfirst(mb_strtolower($result["nombre"])).'</option>';
        }
        $contenido .= '</select>';

        return $contenido;
    }

    public function listarVehiculosControlador():string {
        $contenido = '<select class="form-select w-75" id="vehiculo-tipo-estado" name="vehiculo-tipo-estado">>
                        <option selected></option>';

        $consultaVehiculos = 'SELECT * FROM tipo_estado_mercancia ORDER BY tipo';
        $consultaVehiculos = $this->ejecutarConsulta($consultaVehiculos);

        while ($result = $consultaVehiculos->fetch(\PDO::FETCH_ASSOC)) {
            $contenido .= '<option value="'.$result["tipo"].'">'.ucfirst(mb_strtolower($result["nombre"])).'</option>';
        }
        $contenido .= '</select>';

        return $contenido;
    }
}

?>
