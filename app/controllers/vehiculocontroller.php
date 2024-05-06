<?php

namespace app\controllers;
use app\models\mainModel;

class vehiculoController extends mainModel {
    public function anadirVehiculoControlador() {
        $matricula = $this->limpiarCadena($_POST["nuevo-vehiculo-matricula"]);
        $cargaUtil = $this->limpiarCadena($_POST["nueva-mercancia-carga"]);
        $tipoPeso = $this->limpiarCadena($_POST["nueva-mercancia-carga-tipo-peso"]);

        // Verificar que no existe el usuario
        $verificarVehiculo = "SELECT matricula FROM vehiculos WHERE dni = '$matricula'";
        $verificarVehiculo = $this->ejecutarConsulta($verificarVehiculo);

        if ($verificarVehiculo->rowCount() == 1) {
            $alerta = $this->alertController->alertaSimple('error', 'El vehículo ya existe');
            return $alerta;
        }

        // Verificar matricula
        $matricula = mb_strtoupper($matricula);
        if (mb_strlen($matricula) > 7 || !$this->verificarDatos('([0-9]{4}[A-Z]{3}|[A-Z]{1,2}[0-9]{4}{1,2})', $matricula)) {
            $alerta = $this->alertController->alertaSimple('error', 'La matrícula no es válida');
            return $alerta;
        }

        // Verificar tipo
        $verificarTipo = "SELECT tipo FROM tipo_peso where tipo = '$tipoPeso'";
        $verificarTipo = $this->ejecutarConsulta($verificarTipo);

        if ($verificarTipo->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El tipo de peso es incorrecto');
            return $alerta;
        }

        $datosVehiculo = [
            [
                "campo_nombre" => "matricula",
                "campo_marcador" => ":matricula",
                "campo_valor" => $matricula
            ],
            [
                "campo_nombre" => "carga_util",
                "campo_marcador" => ":carga_util",
                "campo_valor" => $cargaUtil
            ],
            [
                "campo_nombre" => "tipo_peso",
                "campo_marcador" => ":tipo_peso",
                "campo_valor" => $tipoPeso
            ]
        ];

        $anadirVehiculo = $this->guardarDatos("vehiculos", $datosVehiculo);

        if ($anadirVehiculo->rowCount() == 1) {
            $alerta = $this->alertController->alertaRecargar('success', 'Vehículo añadido', APP_URL.'vehiculos');
            

        } else {
            $alerta = $this->alertController->alertaSimple('error', 'Error al añadir el vehículo');
        }

        return $alerta;
    }

    public function listarVehículosControlador():string {
        $contenido = '';

        $consultaVehiculos = "SELECT * FROM usuarios ORDER BY matricula";
        $consultaVehiculos = $this->ejecutarConsulta($consultaVehiculos);

        while ($vehiculo = $consultaVehiculos->fetch(\PDO::FETCH_ASSOC)) {
            // TODO listar vehiculos
        }

        return $contenido;
    }

    public function eliminarVehiculoControlador (string $matricula) {
        $consultaVehiculos = "SELECT matricula FROM vehiculos WHERE matricula = '$matricula'";
        $consultaVehiculos = $this->ejecutarConsulta($consultaVehiculos);

        if ($consultaVehiculos->rowCount() == 1) {
            $deleteVehiculo = "DELETE FROM vehiculos WHERE matricula = '$matricula'";
            $deleteVehiculo = $this->ejecutarConsulta($deleteVehiculo);
            if ($deleteVehiculo->rowCount() == 0) {
                $alerta = $this->alertController->alertaSimple('error', 'Fallo al eliminar el vehículo');
                return $alerta;
            }
            $alerta = $this->alertController->alertaRecargar('success', 'Vehículo eliminado', APP_URL.'vehiculos');
        }
        else {
            $alerta = $this->alertController->alertaSimple('error', 'No existe el vehículo');
        }

        return $alerta;
    }
}

?>