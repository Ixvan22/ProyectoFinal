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

        // Datos para insertar mercancía
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

    // Método para listar mercancia
    public function listarMercanciaControlador():string {
        $contenido = '';

        $consultaMercancia = "SELECT * FROM mercancia WHERE tipo_estado != 5 ORDER BY localizador";
        $consultaMercancia = $this->ejecutarConsulta($consultaMercancia);

        $insTipos = new tiposController();

        while ($mercancia = $consultaMercancia->fetch(\PDO::FETCH_ASSOC)) {
            $consultaTipoPeso = "SELECT nombre FROM tipo_peso WHERE tipo = '".$mercancia['tipo_peso']."'";
            $consultaTipoPeso = $this->consultaToArrayUnico($consultaTipoPeso)[0];

            $consultaTipoEstado = "SELECT * FROM tipo_estado_mercancia WHERE tipo = '".$mercancia["tipo_estado"]."'";
            $consultaTipoEstado = $this->ejecutarConsulta($consultaTipoEstado);
            $consultaTipoEstado = $consultaTipoEstado->fetch(\PDO::FETCH_ASSOC);
            
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
                        <div class="-card-mercancia-main ">
                            <h2>'.$mercancia["localizador"].'</h2>
                            <h5 class="text-center fw-lighter">'.$mercancia["descripcion"].'</h5>
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
                                        <a class="btn btn-danger" href="'.APP_URL.'mercancia/eliminarMercancia/'.$mercancia["localizador"].'">Eliminar</a>
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

    // Método para actualizar datos de la mercancía
    public function actualizarMercanciaControlador():string {
        $localizador = $this->limpiarCadena($_POST["mercanciaLocalizador"]);

        $actualizarMercancia = [];

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
            $alerta = $this->alertController->alertaRecargar('success', 'Mercancía actualizada', APP_URL.'mercancia');
        }
        else {
            $alerta = $this->alertController->alertaSimple('warning', 'No se selecciono nada para actualizar');
        }
        return $alerta;
    } 

    // Método para eliminar una mercancía
    public function eliminarMercanciaControlador(string $localizador):string {
        $consultaMercancia = "SELECT localizador FROM mercancia WHERE localizador = '$localizador'";
        $consultaMercancia = $this->ejecutarConsulta($consultaMercancia);

        if ($consultaMercancia->rowCount() == 1) {
            $deleteMercancia = "DELETE FROM mercancia WHERE localizador = '$localizador'";
            $deleteMercancia = $this->ejecutarConsulta($deleteMercancia);
            if ($deleteMercancia->rowCount() == 0) {
                $alerta = $this->alertController->alertaSimple('error', 'Fallo al eliminar la mercancía');
                return $alerta;
            }
            $alerta = $this->alertController->alertaRecargar('success', 'Mercancía eliminada', APP_URL.'mercancia');
        }
        else {
            $alerta = $this->alertController->alertaSimple('error', 'No existe la mercancía');
        }

        return $alerta;
    }

    // Método que utilizan los clientes para listar una mercancia según el localizador
    public function listarMercanciaClienteControlador():string {
        $contenido = '';
        $localizador = $this->limpiarCadena($_POST["localizador"]);

        $mercancia = "SELECT * FROM mercancia WHERE localizador = '$localizador'";
        $mercancia = $this->ejecutarConsulta($mercancia);

        if ($mercancia->rowCount() == 1) {
            $mercancia = $mercancia->fetch(\PDO::FETCH_ASSOC);

            $consultaCliente = "SELECT nombre, apellidos FROM usuarios WHERE dni = '".$mercancia["cliente"]."'";
            $consultaCliente = $this->ejecutarConsulta($consultaCliente);
            $consultaCliente = $consultaCliente->fetch(\PDO::FETCH_ASSOC);

            $consultaEstado = "SELECT nombre FROM tipo_estado_mercancia WHERE tipo = '".$mercancia["tipo_estado"]."'";
            $consultaEstado = $this->ejecutarConsulta($consultaEstado);
            $consultaEstado = $consultaEstado->fetch(\PDO::FETCH_ASSOC);

            $consultaPeso = "SELECT nombre FROM tipo_peso WHERE tipo = '".$mercancia["tipo_peso"]."'";
            $consultaPeso = $this->ejecutarConsulta($consultaPeso);
            $consultaPeso = $consultaPeso->fetch(\PDO::FETCH_ASSOC);


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
            $contenido = "<h4 class='text-center'>No existe mercancía con el localizador: $localizador</h4>";
        }

        return $contenido;

    }

    // Método para listar mercancía ya entregada
    public function listarMercanciaEntregadaControlador():string {
        $contenido = '';

        $consultaMercancia = "SELECT * FROM mercancia WHERE tipo_estado = '5'";
        $consultaMercancia = $this->ejecutarConsulta($consultaMercancia);

        while ($mercancia = $consultaMercancia->fetch(\PDO::FETCH_ASSOC)) {
            $vehiculo = "SELECT matricula FROM transporte_mercancia WHERE localizador = '".$mercancia["localizador"]."'";
            $vehiculo = $this->ejecutarConsulta($vehiculo);
            if ($vehiculo->rowCount() == 1) {
                $vehiculo = $vehiculo->fetch(\PDO::FETCH_ASSOC)["matricula"];
            }
            else {
                $vehiculo = 'Sin asignar';
            }


            $tipoPeso = "SELECT nombre FROM tipo_peso WHERE tipo = '".$mercancia["tipo_peso"]."'";
            $tipoPeso = $this->ejecutarConsulta($tipoPeso);
            $tipoPeso = $tipoPeso->fetch(\PDO::FETCH_ASSOC);

            $contenido .= '
                <div class="col-12">
                    <div class="-card-mercancia-entregada py-3 px-1">
                        <h5 class="p-0 m-0" id="card-mercancia-entregada-localizador">Localizador: '.$mercancia["localizador"].'</h5>
                        <div class="card-mercancia-entregada-datos">
                            <p class="p-0 m-0">Descripción: <span id="mercancia-entregada-datos-descripcion">'.$mercancia["descripcion"].'</span></p>
                            <p class="p-0 m-0">Vehículo: <span id="mercancia-entregada-datos-vehiculo">'.$vehiculo.'</span></p>
                            <p class="p-0 m-0">Cliente: <span id="mercancia-entregada-datos-cliente">'.$mercancia["cliente"].'</span></p>
                            <p class="p-0 m-0">Peso: <span id="mercancia-entregada-datos-peso">'.$mercancia["peso"].'</span> 
                            <span id="mercancia-entregada-datos-peso-tipo">'.mb_strtoupper($tipoPeso["nombre"]).'</span></p>
                            <a class="btn btn-danger" href="'.APP_URL.'mercanciaEntregada/eliminarMercancia/'.$mercancia["localizador"].'">X</a>
                        </div>
                    </div>
                </div>
            ';
        }


        return $contenido;
    }
}

?>