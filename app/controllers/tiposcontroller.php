<?php

namespace app\controllers;
use app\models\mainModel;

class tiposController extends mainModel {
    // Método para listar cargos
    public function listarCargosControlador(string $cargo = null):string {
        if ($_SESSION["cargo_empleado"] == 1) {
            $contenido = '<select class="form-select w-75" id="trabajador-cargo" name="trabajador-cargo" autocomplete="none">';
        }
        else {
            $contenido = '<select disabled class="form-select w-75" id="trabajador-cargo" name="trabajador-cargo" autocomplete="none">';
        }
        if (is_null($cargo)) $contenido .= '<option selected value="default"></option>';

        $consultaCargo = 'SELECT * FROM tipo_cargo ORDER BY tipo';
        $consultaCargo = $this->ejecutarConsulta($consultaCargo);

        while ($result = $consultaCargo->fetch(\PDO::FETCH_ASSOC)) {
            if (!is_null($cargo) && $cargo == $result["tipo"]) {
                $contenido .= '<option selected value="'.$result["tipo"].'">'.ucfirst(mb_strtolower($result["nombre"])).'</option>';
            }
            else {
                $contenido .= '<option value="'.$result["tipo"].'">'.ucfirst(mb_strtolower($result["nombre"])).'</option>';
            }
        }
        $contenido .= '</select>';

        return $contenido;
    }
    
    // Método para listar pesos
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

    // Método para listar tipos de estado de la mercancía
    public function listarMercanciaControlador(int $tipo = null):string{
        $contenido = '<select class="form-select w-75" name="mercancia-tipo-estado" id="mercancia-tipo-estado">';

        if (is_null($tipo)) {
            $contenido .= '<option selected></option>';
        }

        $consultaMercancia = 'SELECT * FROM tipo_estado_mercancia ORDER BY tipo';
        $consultaMercancia = $this->ejecutarConsulta($consultaMercancia);

        while ($result = $consultaMercancia->fetch(\PDO::FETCH_ASSOC)) {
            if (!is_null($tipo) && $result["tipo"] == $tipo) {
                $contenido .= '<option selected value="'.$result["tipo"].'">'.ucfirst(mb_strtolower($result["nombre"])).'</option>';
            }
            else {
                $contenido .= '<option value="'.$result["tipo"].'">'.ucfirst(mb_strtolower($result["nombre"])).'</option>';
            }
        }
        $contenido .= '</select>';

        return $contenido;
    }

    // Método para listar tipo de estado de los vehículos
    public function listarVehiculosControlador(string $estado = null):string {
        $contenido = '<select class="form-select w-75" id="vehiculo-tipo-estado" name="vehiculo-tipo-estado">';
         if (is_null($estado)) {
             $contenido .= '<option selected></option>';
         }

        $consultaVehiculos = 'SELECT * FROM tipo_estado_vehiculo ORDER BY tipo';
        $consultaVehiculos = $this->ejecutarConsulta($consultaVehiculos);

        while ($result = $consultaVehiculos->fetch(\PDO::FETCH_ASSOC)) {
            if (!is_null($estado) && $result["tipo"] == $estado) {
                $contenido .= '<option selected value="'.$result["tipo"].'">'.ucfirst(mb_strtolower($result["nombre"])).'</option>';
            }
            else {
                $contenido .= '<option value="'.$result["tipo"].'">'.ucfirst(mb_strtolower($result["nombre"])).'</option>';
            }
        }
        $contenido .= '</select>';

        return $contenido;
    }

    // Método para listar las matriculas de los vehículos
    public function listarMatriculasVehiculosControlador(string $vehiculo = null):string{
        $contenido = '<select class="form-select w-75" name="matricula-vehiculo" id="matricula-vehiculo">';

        if (is_null($vehiculo)) {
            $contenido .= '<option selected></option>';
        }

        $consultaVheiculo = 'SELECT matricula FROM vehiculos ORDER BY matricula';
        $consultaVheiculo = $this->ejecutarConsulta($consultaVheiculo);

        while ($result = $consultaVheiculo->fetch(\PDO::FETCH_ASSOC)) {
            if (!is_null($vehiculo) && $result["matricula"] == $vehiculo) {
                $contenido .= '<option selected value="'.$result["matricula"].'">'.mb_strtoupper($result["matricula"]).'</option>';
            }
            else {
                $contenido .= '<option value="'.$result["matricula"].'">'.mb_strtoupper($result["matricula"]).'</option>';
            }
        }
        $contenido .= '</select>';

        return $contenido;
    }

    // Método para listar DNI de clientes
    public function listarDniClientesControlador(string $dni = null):string {
        $contenido = '<select class="form-select w-75" name="dni-cliente" id="dni-cliente">';

        if (is_null($dni)) {
            $contenido .= '<option selected></option>';
        }

        $consultaCliente = 'SELECT dni FROM usuarios ORDER BY nombre';
        $consultaCliente = $this->ejecutarConsulta($consultaCliente);

        while ($result = $consultaCliente->fetch(\PDO::FETCH_ASSOC)) {
            if (!is_null($dni) && $result["dni"] == $dni) {
                $contenido .= '<option selected value="' . $result["dni"] . '">' . mb_strtoupper($result["dni"]) . '</option>';
            } else {
                $contenido .= '<option value="' . $result["dni"] . '">' . mb_strtoupper($result["dni"]) . '</option>';
            }
        }
        $contenido .= '</select>';

        return $contenido;
    }

    // Método para listar DNI de empleados
    public function listarDniEmpleadosControlador():string {
        $contenido = '<select class="form-select w-75" name="dni-cliente" id="dni-cliente">
                        <option selected></option>';


        $consultaEmpleado = 'SELECT dni_empleado FROM cuentas_web';
        $consultaEmpleado = $this->ejecutarConsulta($consultaEmpleado);

        while ($result = $consultaEmpleado->fetch(\PDO::FETCH_ASSOC)) {
            $contenido .= '<option value="' . $result["dni_empleado"] . '">' . mb_strtoupper($result["dni_empleado"]) . '</option>';
        }
        $contenido .= '</select>';

        return $contenido;
    }

    // Método para listar mercancias que no lleve un vehículo y que sean de su tipo de peso
    public function listarVehiculoMercancias(string $tipo_peso):string {
        $contenido = '<select class="form-select w-50" id="asignar-mercancia" name="asignar-mercancia">
                        <option selected></option>';

        $consultaMercancia = "SELECT localizador FROM mercancia WHERE localizador NOT IN 
                                (SELECT DISTINCT localizador FROM transporte_mercancia)
                                AND tipo_peso = '".$tipo_peso."'
                                AND tipo_estado != 5";
        $consultaMercancia = $this->ejecutarConsulta($consultaMercancia);
        while ($result = $consultaMercancia->fetch(\PDO::FETCH_ASSOC)) {
            $contenido .= '<option value="'.$result["localizador"].'">'.$result["localizador"].'</option>';
        }
        $contenido .= '</select>';

        return $contenido;
    }
}

?>
