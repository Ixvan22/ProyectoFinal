<?php

namespace app\controllers;
use app\models\mainModel;
use app\controllers\clienteController;

class mercanciaController extends mainModel {

    // Controlador para anadir usuarios
    public function anadirMercanciaControlador():string {
        $peso = $this->limpiarCadena($_POST["nueva-mercancia-peso"]);
        $tipoPeso = $this->limpiarCadena($_POST["tipo-peso"]);
        $tipoEstado = $this->limpiarCadena($_POST["mercancia-tipo-estado"]);
        $descripcion = $this->limpiarCadena($_POST["nueva-mercancia-descripcion"]);

        // Verificar peso
        if ($peso <= 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El peso es incorrecto');
            return $alerta;
        }

        if (isset($_POST["mercancia-cliente-existente"]) && $_POST["mercancia-cliente-existente"] != '') {
            $cliente = $_POST["mercancia-cliente-existente"];
        }
        else {
            $insCliente = new clienteController();
            $insCliente->anadirClienteControlador();
            $cliente = $_POST["nuevo-cliente-dni"];
        }

        // Verificar cliente
        $verificarCliente = "SELECT dni FROM usuarios WHERE dni = '$cliente'";
        $verificarCliente = $this->ejecutarConsulta($verificarCliente);

        if ($verificarCliente->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El cliente no existe / no se puede añadir');
            return $alerta;
        }
        
        
        // Verificar tipo peso
        $verificarTipoPeso = "SELECT tipo FROM tipo_peso WHERE tipo = '$tipoPeso'";
        $verificarTipoPeso = $this->ejecutarConsulta($verificarTipoPeso);

        if ($verificarTipoPeso->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El tipo de peso no existe');
            return $alerta;
        }

        // Verificar tipo estado
        $verificarTipoEstado = "SELECT tipo FROM tipo_estado_mercancia WHERE tipo = '$tipoEstado'";
        $verificarTipoEstado = $this->ejecutarConsulta($verificarTipoEstado);

        if ($verificarTipoEstado->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El tipo de estado no existe');
            return $alerta;
        }

        $datosMercancia = [
            [
                "campo_nombre" => "cliente",
                "campo_marcador" => ":cliente",
                "campo_valor" => $cliente
            ],
            [
                "campo_nombre" => "peso",
                "campo_marcador" => ":peso",
                "campo_valor" => $peso
            ],
            [
                "campo_nombre" => "tipo_estado",
                "campo_marcador" => ":tipo_estado",
                "campo_valor" => $tipoEstado
            ],
            [
                "campo_nombre" => "tipo_peso",
                "campo_marcador" => ":tipo_peso",
                "campo_valor" => $tipoPeso
            ],
            [
                "campo_nombre" => "descripcion",
                "campo_marcador" => ":descripcion",
                "campo_valor" => $descripcion
            ]
        ];

        $anadirUser = $this->guardarDatos("mercancia", $datosMercancia);

        if ($anadirUser->rowCount() == 1) {
            $alerta = $this->alertController->alertaRecargar('success', 'Mercancía añadida', APP_URL.'mercancia');

        } else {
            $alerta = $this->alertController->alertaSimple('error', 'Error al añadir la mercancía');
        }

        return $alerta;
    }

    public function listarMercanciaControlador():string {
        $contenido = '';

        $consultaMercancia = "SELECT * FROM mercancia ORDER BY localizador";
        $consultaMercancia = $this->ejecutarConsulta($consultaMercancia);

        $insTipos = new tiposController();

        while ($mercancia = $consultaMercancia->fetch(\PDO::FETCH_ASSOC)) {
            $consultaTipoPeso = "SELECT nombre FROM tipo_peso WHERE tipo = '".$mercancia['tipo_peso']."'";
            $consultaTipoPeso = $this->consultaToArrayUnico($consultaTipoPeso)[0];

            $consultaTipoEstado = "SELECT * FROM tipo_estado_mercancia WHERE tipo = '".$mercancia["tipo_estado"]."'";
            $consultaTipoEstado = $this->ejecutarConsulta($consultaTipoEstado);
            $consultaTipoEstado = $consultaTipoEstado->fetch(\PDO::FETCH_ASSOC);

            $vehiculoMercancia = "SELECT matricula FROM transporte_mercancia WHERE localizador = '".$mercancia["localizador"]."'";
            $vehiculoMercancia = $this->consultaToArrayUnico($vehiculoMercancia);

            $contenido .= '
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="-card-mercancia" data-bs-toggle="modal" data-bs-target="#modal-'.$mercancia["localizador"].'">
                        <div class="-card-mercancia-header">
                            <p> <span id="-card-mercancia-status-icon">
            ';
            if ($consultaTipoEstado["tipo"] == 1) {
                $contenido .= '<i class="fa-solid fa-circle" style="color: orange;">';
            }
            else {
                $contenido .= '<i class="fa-solid fa-circle" style="color: green;">';
            }
            $contenido .= '</i>
                            </span> '.$consultaTipoEstado["nombre"].'</p>
                            <p>
                                <span id="-card-mercancia-status-weight">'.$mercancia["peso"].'</span>
                                <span id="-card-mercancia-status-weight-type">'.$consultaTipoPeso.'</span>
                            </p>
                        </div>
                        <div class="-card-mercancia-main">
                            <p>'.$mercancia["localizador"].'</p>
                        </div>
                    </div>
            ';

            $contenido .= '
                    <!-- Modal -->
                    <div class="modal fade" id="modal-'.$mercancia["localizador"].'" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Localizador: <span id="mercancia-modal-localizador">'.$mercancia["localizador"].'</span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="'.APP_URL.'mercancia" method="post">
                                    <div class="modal-body">
                                        <div class="-modal-mercancia">
                                            <div class="row d-flex align-items-center">
                                                <label class="w-25" for="matricula-vehiculo">Vehículo</label>';
            if (count($vehiculoMercancia) == 0) {
                $contenido .= $insTipos->listarMatriculasVehiculosControlador();
            }
            else {
                $vehiculoMercancia = $vehiculoMercancia[0];
                $contenido .= $insTipos->listarMatriculasVehiculosControlador($vehiculoMercancia);
            }

            $contenido .= '                </div>
                                            <div class="row d-flex align-items-center my-2">
                                                <label class="w-25" for="dni-cliente">Cliente</label>
                                                '.$insTipos->listarDniClientesControlador($mercancia["cliente"]).'
                                            </div>
                                            <div class="row d-flex align-items-center my-2">
                                                <label class="w-25" for="mercancia-estado-asignado">Estado</label>
                                                '.$insTipos ->listarMercanciaControlador($mercancia['tipo_estado']).'
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" value="'.$mercancia["localizador"].'" name="mercanciaLocalizador"/>
                                        <button type="submit" class="btn btn-success" name="guardar-estado-mercancia">Guardar cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $contenido;
    }

    public function actualizarMercanciaControlador():string {
        $localizador = $this->limpiarCadena($_POST["mercanciaLocalizador"]);

        $actualizarMercancia = [];
        $actualizarTransporteMercancia = [];
        
        if (isset($_POST["matricula-vehiculo"]) && $_POST["matricula-vehiculo"] != "") {
            $vehiculo = $this->limpiarCadena($_POST["matricula-vehiculo"]);

            $consultaVehiculo = "SELECT matricula FROM vehiculos WHERE matricula = '".$vehiculo."'";
            $consultaVehiculo = $this->ejecutarConsulta($consultaVehiculo);

            if ($consultaVehiculo->rowCount() == 0) {
                $alerta = $this->alertController->alertaSimple('error', 'El vehículo no existe');
                return $alerta;
            }

            $actualizarTransporteMercancia[] = [
                    "campo_nombre" => "matricula",
                    "campo_marcador" => ":matricula",
                    "campo_valor" => $vehiculo
                ];
        }

        if (isset($_POST["dni-cliente"]) && $_POST["dni-cliente"] != "") {
            $dni = $this->limpiarCadena($_POST["dni-cliente"]);

            $comprobarCliente = "SELECT cliente FROM mercancia WHERE localizador = '$localizador'";
            $comprobarCliente = $this->ejecutarConsulta($comprobarCliente);
            $comprobarCliente = $comprobarCliente->fetch(\PDO::FETCH_ASSOC);

            if ($comprobarCliente["cliente"] != $dni) {
                $consultaCliente = "SELECT dni FROM usuarios WHERE dni = '".$dni."'";
                $consultaCliente = $this->ejecutarConsulta($consultaCliente);

                if ($consultaCliente->rowCount() == 0) {
                    $alerta = $this->alertController->alertaSimple('error', 'El cliente no existe');
                    return $alerta;
                }
                $actualizarMercancia[] = [
                    "campo_nombre" => "cliente",
                    "campo_marcador" => ":cliente",
                    "campo_valor" => $dni
                ];
            }
        }

        if (isset($_POST["mercancia-tipo-estado"]) && $_POST["mercancia-tipo-estado"] != "") {
            $estado = $this->limpiarCadena($_POST["mercancia-tipo-estado"]);

            $comprobarEstado = "SELECT tipo_estado FROM mercancia WHERE localizador = '$localizador'";
            $comprobarEstado = $this->ejecutarConsulta($comprobarEstado);
            $comprobarEstado = $comprobarEstado->fetch(\PDO::FETCH_ASSOC);

            if ($comprobarEstado["tipo_estado"] != $estado) {

                $consultaEstado = "SELECT tipo FROM tipo_estado_mercancia WHERE tipo = '" . $estado . "'";
                $consultaEstado = $this->ejecutarConsulta($consultaEstado);

                if ($consultaEstado->rowCount() == 0) {
                    $alerta = $this->alertController->alertaSimple('error', 'El estado es incorrecto');
                    return $alerta;
                }

                $actualizarMercancia[] = [
                    "campo_nombre" => "tipo_estado",
                    "campo_marcador" => ":tipo_estado",
                    "campo_valor" => $estado
                ];
            }

        }

        if (count($actualizarMercancia) > 0) {
            $mercanciaActualizada = $this->actualizarDatos("mercancia", $actualizarMercancia, "localizador = '".$localizador."'");

            if ($mercanciaActualizada->rowCount() == 0) {
                $alerta = $this->alertController->alertaSimple('error', 'Fallo al actualizar los datos');
                return $alerta;
            }


        }
        if (count($actualizarTransporteMercancia) > 0) {

            $consultaTransporteMercancia = "SELECT matricula FROM transporte_mercancia WHERE localizador = '$localizador'";
            $consultaTransporteMercancia = $this->ejecutarConsulta($consultaTransporteMercancia);

            if ($consultaTransporteMercancia->rowCount() == 0) {
                $actualizarTransporteMercancia[] = [
                    "campo_nombre" => "localizador",
                    "campo_marcador" => ":localizador",
                    "campo_valor" => $localizador
                ];
                $insertarTransporte = $this->guardarDatos("transporte_mercancia", $actualizarTransporteMercancia);

                if ($insertarTransporte->rowCount() == 1) {
                    $alerta = $this->alertController->alertaRecargar('success', 'Mercancía actualizada', APP_URL.'mercancia');
                    return $alerta;
                }
                else {
                    $alerta = $this->alertController->alertaSimple('error', 'No se puede insertar el transporte');
                    return $alerta;
                }
            }

            $transporteActualizado = $this->actualizarDatos("transporte_mercancia", $actualizarTransporteMercancia, "localizador = '".$localizador."'");

            if ($transporteActualizado->rowCount() == 0) {
                $alerta = $this->alertController->alertaRecargar('warning', 'No se pudo actualizar el vehículo', APP_URL.'mercancia');
                return $alerta;
            }
            $alerta = $this->alertController->alertaRecargar('success', 'Mercancía actualizada', APP_URL.'mercancia');
        }
        else {
            $alerta = $this->alertController->alertaRecargar('success', 'Mercancía actualizada', APP_URL.'mercancia');
        }

        if (count($actualizarMercancia) <= 0 && count($actualizarTransporteMercancia) <= 0) {
            $alerta = $this->alertController->alertaSimple('warning', 'No se selecciono nada para actualizar');
        }
        return $alerta;
    } 

    public function eliminarMercanciaControlador (string $localizador) {
        $consultaMercancia = "SELECT localizador FROM mercancia WHERE localizador = '$localizador'";
        $consultaMercancia = $this->ejecutarConsulta($consultaMercancia);

        if ($consultaMercancia->rowCount() == 1) {
            $deleteMercancia = "DELETE FROM mercancia WHERE localizador = '$localizador'";
            $deleteMercancia = $this->ejecutarConsulta($deleteMercancia);
            if ($deleteMercancia->rowCount() == 0) {
                $alerta = $this->alertController->alertaSimple('error', 'Fallo al eliminar la mercancía');
                return $alerta;
            }
            $alerta = $this->alertController->alertaRecargar('success', 'Mercancía eliminada', APP_URL.'vehiculos');
        }
        else {
            $alerta = $this->alertController->alertaSimple('error', 'No existe la mercancía');
        }

        return $alerta;
    }

    public function listarMercanciaClienteControlador():string {
        $contenido = '';
        $localizador = $this->limpiarCadena($_POST["localizador"]);

        $mercancia = "SELECT * FROM mercancia WHERE localizador = '$localizador'";
        $mercancia = $this->ejecutarConsulta($mercancia);

        $consultaCliente = "SELECT nombre, apellidos FROM usuarios WHERE dni = '".$mercancia["cliente"]."'";
        $consultaCliente = $this->ejecutarConsulta($consultaCliente);
        $consultaCliente = $consultaCliente->fetch(\PDO::FETCH_ASSOC);

        $consultaEstado = "SELECT nombre FROM tipo_estado_mercancia WHERE tipo = '".$mercancia["tipo_estado"]."'";
        $consultaEstado = $this->ejecutarConsulta($consultaEstado);
        $consultaEstado = $consultaEstado->fetch(\PDO::FETCH_ASSOC);

        $consultaPeso = "SELECT nombre FROM tipo_peso WHERE tipo = '".$mercancia["tipo_peso"]."'";
        $consultaPeso = $this->ejecutarConsulta($consultaPeso);
        $consultaPeso = $consultaPeso->fetch(\PDO::FETCH_ASSOC);

        if ($mercancia->rowCount() == 1) {
            $mercancia = $mercancia->fetch(\PDO::FETCH_ASSOC);
            
            $contenido .= '
            <div class="-localizar-paquete-card-group">
                <p class="p-0 m-0 fw-bold">Número de seguimiento: </p>
                <p class="p-0 m-0">'.$mercancia["localizador"].'</p>
            </div>
            <div class="-localizar-paquete-card-group">
                <p class="p-0 m-0 fw-bold">DNI: </p>
                <p class="p-0 m-0">'.mb_strtoupper($mercancia["cliente"]).'</p>
            </div>
            <div class="-localizar-paquete-card-group">
                <p class="p-0 m-0 fw-bold">Nombre: </p>
                <p class="p-0 m-0">'.ucfirst(mb_strtolower($consultaCliente["nombre"])).'</p>
            </div>
            <div class="-localizar-paquete-card-group">
                <p class="p-0 m-0 fw-bold">Apellidos: </p>
                <p class="p-0 m-0">'.ucfirst(mb_strtolower($consultaCliente["apellidos"])).'</p>
            </div>
            <div class="-localizar-paquete-card-group">
                <p class="p-0 m-0 fw-bold">Estado: </p>
                <p class="p-0 m-0">'.ucfirst(mb_strtolower($consultaEstado["nombre"])).'</p>
            </div>
            <div class="-localizar-paquete-card-group">
                <p class="p-0 m-0 fw-bold">Peso: </p>
                <p class="p-0 m-0">'.$mercancia["peso"].' '.mb_strtoupper($consultaPeso["nombre"]).'</p>
            </div>
            ';
        }   
        else {
            $contenido = $this->alertController->alertaSimple('error', 'No existe la mercancía');
        }

        return $contenido;

    }
}

?>