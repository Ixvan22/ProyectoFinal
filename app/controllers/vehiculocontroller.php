<?php

namespace app\controllers;
use app\models\mainModel;

class vehiculoController extends mainModel {
    public function anadirVehiculoControlador() {
        $matricula = $this->limpiarCadena($_POST["nuevo-vehiculo-matricula"]);
        $cargaUtil = $this->limpiarCadena($_POST["nuevo-vehicuñp-carga"]);
        $tipoPeso = $this->limpiarCadena($_POST["tipo-peso"]);

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

        $consultaVehiculos = "SELECT * FROM vehiculos ORDER BY matricula";
        $consultaVehiculos = $this->ejecutarConsulta($consultaVehiculos);

        while ($vehiculo = $consultaVehiculos->fetch(\PDO::FETCH_ASSOC)) {
            $consultaTipoPeso = "SELECT nombre FROM tipo_peso WHERE tipo = '".$vehiculo['tipo_peso']."'";
            $consultaTipoPeso = $this->consultaToArrayUnico($consultaTipoPeso)[0];

            $consultaPesoActual = "SELECT localizador FROM transporte_mercancia WHERE matricula = '".$vehiculo["matricula"]."'";
            $consultaPesoActual = $this->ejecutarConsulta($consultaPesoActual);

            $peso = 0;
            while ($mercancia = $consultaPesoActual->fetch(\PDO::FETCH_ASSOC)) {
                $consultaPesoMercancia = "SELECT peso FROM mercancia WHERE localizador = '$mercancia'";
                $consultaPesoMercancia = $this->consultaToArrayUnico($consultaPesoMercancia)[0];
                $peso += $consultaPesoMercancia;
            }

            $contenido .= '
            <div class="col-lg-3 col-md-4 col-sm-6 col-12" data-bs-toggle="modal" data-bs-target="#modal-1234ABC">
                <div class="-card-vehicle">
                    <div class="-card-vehicle-header">
                        <p><span id="-card-vehicle-status-icon"><i class="fa-solid fa-circle" style="color: green;"></i></span> Listo</p>
                        <p>
                            <span id="-card-vehicle-status-weight">'.$peso.'</span>
                            / 
                            <span id="-card-vehicle-status-weight-max">'.$vehiculo["carga_util"].'</span>
                            
                            <span id="-card-vehicle-status-weight-type">'.$consultaTipoPeso.'</span>
                        </p>
                    </div>
                    <div class="-card-vehicle-main">
                        <p>'.$vehiculo["matricula"].'</p>
                    </div>
                </div>
            </div>
            ';

            // TODO LISTAR MERCANCIA Y LISTAR ESTADOS
            $contenido .= '
            <!-- Modal -->
            <div class="modal fade" id="modal-1234ABC" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Vehículo: <span id="vehiculo-modal-matricula">'.$vehiculo["matricula"].'</span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="." method="post">
                            <div class="modal-body">
                                <div class="-modal-mercancia">
                                    <div class="row d-flex align-items-center">
                                        <label class="w-50" for="vehiculo-asignar-mercancia">Añadir mercancia:</label>
                                        <select class="form-select w-50" id="vehiculo-asignar-mercancia" name="vehiculo-mercancia-asignada">
                                            <option value="default"></option>
                                            <option value="123456789123456">123456789123456</option>
                                        </select>
                                    </div>
                                    <div class="row d-flex align-items-center my-2">
                                        <label class="w-25" for="vehiculo-estado-asignado">Estado:</label>
                                        <select class="form-select w-75" id="vehiculo-estado-asignado" name="vehiculo-estado-asignado">
                                            <option value="0">Sin mercancia</option>
                                            <option value="1">Esperando asignación</option>
                                            <option value="2">Cargando mercancía</option>
                                            <option value="3">Listo</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="'.APP_URL.'vehiculos/eliminarVehiculo/'.$vehiculo["matricula"].'" class="btn btn-danger">Eliminar</a>
                                <div class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-mercanciaAsignada">Mercancia asignada</div>
                                <button type="submit" class="btn btn-success" name="guardar-estado-vehículo">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            ';

            // TODO LISTAR MERCANCIAS EN EL VEHICULO
            $contenido .= '
            <!-- Modal -->
            <div class="modal fade" id="modal-mercanciaAsignada" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Vehículo: <span id="vehiculo-modal-matricula">'.$vehiculo["matricula"].'</span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="-modal-mercancia">
                                <div class="row d-flex align-items-center">
                                    <h6 class="w-50">123456789123</h6>
                                    <h6 class="w-25 text-end">80 KG</h6>
                                    <a href="'.APP_URL.'vehiculos/eliminarMercancia/'.$vehiculo["matricula"].'/mercancia" class="w-25 text-end">
                                    <i class="fa-solid fa-x btn btn-danger"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
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