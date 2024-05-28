<?php

namespace app\controllers;
use app\models\mainModel;

class vehiculoController extends mainModel {
    // Método para añadir vehículos
    public function anadirVehiculoControlador():string {
        $matricula = $this->limpiarCadena($_POST["nuevo-vehiculo-matricula"]);
        $cargaUtil = $this->limpiarCadena($_POST["nuevo-vehiculo-carga"]);
        $tipoPeso = $this->limpiarCadena($_POST["tipo-peso"]);
        $tipoEstado = $this->limpiarCadena($_POST["vehiculo-tipo-estado"]);

        // Verificar que no existe el vehiculo
        $verificarVehiculo = "SELECT matricula FROM vehiculos WHERE matricula = '$matricula'";
        $verificarVehiculo = $this->ejecutarConsulta($verificarVehiculo);

        if ($verificarVehiculo->rowCount() == 1) {
            $alerta = $this->alertController->alertaSimple('error', 'El vehículo ya existe');
            return $alerta;
        }

        // Verificar matricula
        $matricula = mb_strtoupper($matricula);
        if (mb_strlen($matricula) > 7 || !$this->verificarDatos('([0-9]{4}[A-Z]{3}|[A-Z]{1,2}[0-9]{4}[A-Z]{1,2})', $matricula)) {
            $alerta = $this->alertController->alertaSimple('error', 'La matrícula no es válida');
            return $alerta;
        }

        // Verificar estado
        $verificarEstado = "SELECT tipo FROM tipo_estado_vehiculo where tipo = '$tipoEstado'";
        $verificarEstado = $this->ejecutarConsulta($verificarEstado);

        if ($verificarEstado->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El tipo de estado es incorrecto');
            return $alerta;
        }

        // Verificar carga util
        if ($cargaUtil <= 0) {
            $alerta = $this->alertController->alertaSimple('error', 'La carga útil es incorrecta');
            return $alerta;
        }

        // Verificar tipo
        $verificarTipo = "SELECT tipo FROM tipo_peso where tipo = '$tipoPeso'";
        $verificarTipo = $this->ejecutarConsulta($verificarTipo);

        if ($verificarTipo->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El tipo de peso es incorrecto');
            return $alerta;
        }

        // Datos del vehículo a insertar
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
            ],
            [
                "campo_nombre" => "tipo_estado",
                "campo_marcador" => ":tipo_estado",
                "campo_valor" => $tipoEstado
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

    // Método para listar vehículos
    public function listarVehiculosControlador():string {
        $contenido = '';

        $consultaVehiculos = "SELECT * FROM vehiculos ORDER BY matricula";
        $consultaVehiculos = $this->ejecutarConsulta($consultaVehiculos);

        $insTipos = new tiposController();

        while ($vehiculo = $consultaVehiculos->fetch(\PDO::FETCH_ASSOC)) {
            $consultaTipoPeso = "SELECT nombre FROM tipo_peso WHERE tipo = '".$vehiculo['tipo_peso']."'";
            $consultaTipoPeso = $this->consultaToArrayUnico($consultaTipoPeso)[0];

            $consultaPesoActual = "SELECT localizador FROM transporte_mercancia WHERE matricula = '".$vehiculo["matricula"]."'";
            $consultaPesoActual = $this->ejecutarConsulta($consultaPesoActual);

            $peso = 0;
            while ($mercancia = $consultaPesoActual->fetch(\PDO::FETCH_ASSOC)) {
                $consultaPesoMercancia = "SELECT peso FROM mercancia WHERE localizador = '".$mercancia["localizador"]."'";
                $consultaPesoMercancia = $this->consultaToArrayUnico($consultaPesoMercancia)[0];
                $peso += $consultaPesoMercancia;
            }

            $contenido .= '
            <div class="col-lg-3 col-md-4 col-sm-6 col-12" data-bs-toggle="modal" data-bs-target="#modal-'.$vehiculo["matricula"].'">
                <div class="-card-vehicle">
                    <div class="-card-vehicle-header">';

            $consultaTipoEstado = "SELECT nombre FROM tipo_estado_vehiculo WHERE tipo = '".$vehiculo["tipo_estado"]."'";
            $consultaTipoEstado = $this->ejecutarConsulta($consultaTipoEstado);
            $consultaTipoEstado = $consultaTipoEstado->fetch(\PDO::FETCH_ASSOC);
            if ($vehiculo["tipo_estado"] == 4) {
                $contenido .= '<p><span id="-card-vehicle-status-icon"><i class="fa-solid fa-circle" style="color: green;"></i></span> '.$consultaTipoEstado["nombre"].'</p>';
            }
            else {
                $contenido .= '<p><span id="-card-vehicle-status-icon"><i class="fa-solid fa-circle" style="color: orange;"></i></span> '.$consultaTipoEstado["nombre"].'</p>';
            }

            $contenido .= '
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

            $contenido .= '
            <!-- Modal -->
            <div class="modal fade" id="modal-'.$vehiculo["matricula"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Vehículo: <span id="vehiculo-modal-matricula">'.$vehiculo["matricula"].'</span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="'.APP_URL.'vehiculos" method="post">
                            <div class="modal-body">
                            <div class="-modal-mercancia">';

            if ($_SESSION["cargo_empleado"] == 1 || $_SESSION["cargo_empleado"] == 3) {
                $contenido .= '<div class="row d-flex align-items-center">
                                    <label class="w-50" for="asignar-mercancia">Añadir mercancía:</label>';

                $contenido .= $insTipos->listarVehiculoMercancias($vehiculo["tipo_peso"]);

                $contenido .= '     </div>';
            }
            if ($_SESSION["cargo_empleado"] == 1 || $_SESSION["cargo_empleado"] == 2) {
                $contenido .= '
                                    <div class="row d-flex align-items-center my-2">
                                        <label class="w-25" for="vehiculo-tipo-estado">Estado:</label>
                                        ' . $insTipos->listarVehiculosControlador($vehiculo["tipo_estado"]) . '
                                    </div>';
            }
            $contenido .= '</div>
                            </div>
                            <div class="modal-footer">
                                <a href="'.APP_URL.'vehiculos/eliminarVehiculo/'.$vehiculo["matricula"].'" class="btn btn-danger">Eliminar</a>';
            if ($_SESSION["cargo_empleado"] == 1 || $_SESSION["cargo_empleado"] == 3) {
                $contenido .= '<div class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-mercanciaAsignada-' . $vehiculo["matricula"] . '">Mercancía asignada</div>';
            }
            $contenido .= '<input type="hidden" value="'.$vehiculo["matricula"].'" name="vehiculoMatricula"/>
                                <button type="submit" class="btn btn-success" name="guardar-estado-vehículo">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            ';

            $contenido .= '
                <!-- Modal -->
                <div class="modal fade" id="modal-mercanciaAsignada-'.$vehiculo["matricula"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Vehículo: <span id="vehiculo-modal-matricula">'.$vehiculo["matricula"].'</span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="-modal-mercancia">
            ';

            $consultaMercanciaVehiculo = "SELECT localizador FROM transporte_mercancia WHERE matricula = '".$vehiculo["matricula"]."'";
            $consultaMercanciaVehiculo = $this->ejecutarConsulta($consultaMercanciaVehiculo);
            while ($mercanciaVehiculo = $consultaMercanciaVehiculo->fetch(\PDO::FETCH_ASSOC)) {
                $consultaMercancia = "SELECT * FROM mercancia WHERE localizador = '".$mercanciaVehiculo["localizador"]."'";
                $consultaMercancia = $this->ejecutarConsulta($consultaMercancia);
                $consultaMercancia = $consultaMercancia->fetch(\PDO::FETCH_ASSOC);

                $consultaPesoMercancia = "SELECT nombre FROM tipo_peso WHERE tipo = '".$consultaMercancia["tipo_peso"]."'";
                $consultaPesoMercancia = $this->ejecutarConsulta($consultaPesoMercancia);
                $consultaPesoMercancia = $consultaPesoMercancia->fetch(\PDO::FETCH_ASSOC);

                $contenido .= '
                                    <div class="row d-flex align-items-center my-1">
                                        <h6 class="w-50">'.$consultaMercancia["localizador"].'</h6>
                                        <h6 class="w-25 text-end">'.$consultaMercancia["peso"].' '.$consultaPesoMercancia["nombre"].'</h6>
                                        <a href="'.APP_URL.'vehiculos/eliminarMercanciaVehiculo/'.$vehiculo["matricula"].'/'.$mercanciaVehiculo["localizador"].'" class="w-25 text-end">
                                        <i class="fa-solid fa-x btn btn-danger"></i></a>
                                    </div>
                ';

            }
            $contenido .= '</div></div></div></div></div>';

        }

        return $contenido;
    }

    // Método para eliminar un vehículo
    public function eliminarVehiculoControlador (string $matricula):string {
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

    // Método para eliminar mercancía de un vehículo
    public function eliminarMercanciaVehiculo(string $vehiculo, string $localizador):string {
        $consultaMercancia = "SELECT localizador FROM transporte_mercancia WHERE localizador = '$localizador' AND matricula = '$vehiculo'";
        $consultaMercancia = $this->ejecutarConsulta($consultaMercancia);

        if ($consultaMercancia->rowCount() == 1) {
            $deleteMercancia = "DELETE FROM transporte_mercancia WHERE localizador = '$localizador' AND matricula = '$vehiculo'";
            $deleteMercancia = $this->ejecutarConsulta($deleteMercancia);
            if ($deleteMercancia->rowCount() == 0) {
                $alerta = $this->alertController->alertaSimple('error', 'Fallo al eliminar la mercancía');
                return $alerta;
            }
            $alerta = $this->alertController->alertaRecargar('success', 'Mercancía eliminada', APP_URL.'vehiculos');
        }
        else {
            $alerta = $this->alertController->alertaSimple('error', 'La mercancía no está en el vehículo');
        }

        return $alerta;
    }

    // Método para actualizar vehículo
    public function actualizarVehiculoControlador():string {
        $matricula = $this->limpiarCadena($_POST["vehiculoMatricula"]);

        // Alerta por defecto en caso de que no se actualice nada
        $alerta = $this->alertController->alertaSimple('error', 'No hay nada nuevo que actualizar');

        $verificarVehiculo = "SELECT matricula, carga_util, tipo_peso FROM vehiculos WHERE matricula = '$matricula'";
        $verificarVehiculo = $this->ejecutarConsulta($verificarVehiculo);

        $actualizarVehiculo = [];
        $actualizarTransporte = [];
        $updateTransporte = false;
        
        if ($verificarVehiculo->rowCount() == 1) {
            if (isset($_POST["asignar-mercancia"]) && $_POST["asignar-mercancia"] != '') {
                $mercancia = $this->limpiarCadena($_POST["asignar-mercancia"]);

                $verificarMercancia = "SELECT localizador, peso, tipo_peso FROM mercancia WHERE localizador = '$mercancia'";
                $verificarMercancia = $this->ejecutarConsulta($verificarMercancia);

                if ($verificarMercancia->rowCount() == 1) {

                    $verificarMercancia = $verificarMercancia->fetch(\PDO::FETCH_ASSOC);
                    $verificarVehiculo = $verificarVehiculo->fetch(\PDO::FETCH_ASSOC);
                    if ($verificarMercancia["tipo_peso"] != $verificarVehiculo["tipo_peso"]) {
                        $alerta = $this->alertController->alertaSimple('error', 'El tipo de la mercancia no correspone con el vehículo');
                        return $alerta;
                    }

                    $sumaPeso = "SELECT SUM(peso) FROM mercancia WHERE localizador IN 
                                      (SELECT localizador FROM transporte_mercancia WHERE matricula = '$matricula')";
                    $sumaPeso = $this->ejecutarConsulta($sumaPeso);
                    $sumaPeso = $sumaPeso->fetch(\PDO::FETCH_NUM);

                    if ($verificarMercancia["peso"] + $sumaPeso[0] > $verificarVehiculo["carga_util"]) {
                        $alerta = $this->alertController->alertaSimple('error', 'La mercancía excede de la carga útil del vehículo');
                        return $alerta;
                    }

                    $actualizarTransporte[] = [
                        "campo_nombre" => "matricula",
                        "campo_marcador" => ":matricula",
                        "campo_valor" => $matricula
                    ];

                    $consultaTransporteMercancia = "SELECT matricula FROM transporte_mercancia WHERE localizador = '$mercancia'";
                    $consultaTransporteMercancia = $this->ejecutarConsulta($consultaTransporteMercancia);

                    if ($consultaTransporteMercancia->rowCount() == 0) {

                        $actualizarTransporte[] = [
                            "campo_nombre" => "localizador",
                            "campo_marcador" => ":localizador",
                            "campo_valor" => $mercancia
                        ];

                        $insertarTransporte = $this->guardarDatos("transporte_mercancia", $actualizarTransporte);
                        if ($insertarTransporte->rowCount() == 0) {
                            $alerta = $this->alertController->alertaSimple('error', 'No se pudo asignar la mercancía');
                            return $alerta;
                        }
                    }
                    else {
                        $transporteActualizado = $this->actualizarDatos("transporte_mercancia", $actualizarTransporte, "localizador = '".$mercancia."'");
                        if ($transporteActualizado->rowCount() == 0) {
                            $alerta = $this->alertController->alertaSimple('error', 'No se pudo asignar la mercancía');
                            return $alerta;
                        }
                    }
                    $updateTransporte = true;
                }
                else {
                    $alerta = $this->alertController->alertaSimple('error', 'No existe la mercancía');
                    return $alerta;
                }
            }

            if (isset($_POST["vehiculo-tipo-estado"]) && $_POST["vehiculo-tipo-estado"] != "") {
                $tipo = $this->limpiarCadena($_POST["vehiculo-tipo-estado"]);

                $verificarTipo = "SELECT tipo FROM tipo_estado_vehiculo WHERE tipo = '$tipo'";
                $verificarTipo = $this->ejecutarConsulta($verificarTipo);

                if ($verificarTipo->rowCount() == 1) {
                    $verificarTipoDistinto = "SELECT tipo_estado FROM vehiculos WHERE matricula = '$matricula'";
                    $verificarTipoDistinto = $this->ejecutarConsulta($verificarTipoDistinto);
                    $verificarTipoDistinto = $verificarTipoDistinto->fetch(\PDO::FETCH_ASSOC);

                    if ($verificarTipoDistinto["tipo_estado"] != $tipo) {
                        $actualizarVehiculo[] = [
                            "campo_nombre" => "tipo_estado",
                            "campo_marcador" => ":tipo_estado",
                            "campo_valor" => $tipo
                        ];
                    }
                }
                else {
                    $alerta = $this->alertController->alertaSimple('error', 'El estado es incorrecto');
                    return $alerta;
                }
            }
            if (count($actualizarVehiculo) > 0) {
                $actualizarVehiculo = $this->actualizarDatos("vehiculos", $actualizarVehiculo, "matricula = '$matricula'");

                if ($actualizarVehiculo->rowCount() == 1) {
                    $alerta = $this->alertController->alertaRecargar('success', 'Vehículo actualizado', APP_URL . 'vehiculos');
                    return $alerta;
                } else {
                    if ($updateTransporte) {
                        $alerta = $this->alertController->alertaRecargar('warning', 'No se pudo actualizar el vehículo. La mercancía se actualizó', APP_URL . 'vehiculos');
                        return $alerta;
                    }
                    $alerta = $this->alertController->alertaSimple('error', 'Fallo al actualizar el vehículo');
                    return $alerta;
                }
            }
            if ($updateTransporte) {
                $alerta = $this->alertController->alertaRecargar('success', 'Mercancía añadida', APP_URL . 'vehiculos');
                return $alerta;
            }

        }
        else {
            $alerta = $this->alertController->alertaSimple('error', 'No existe el vehículo');
        }

        return $alerta;
    }
}

?>