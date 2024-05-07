<?php

namespace app\controllers;
use app\models\mainModel;
use app\controllers\clienteController;

class mercanciaController extends mainModel {

    // Controlador para anadir usuarios
    public function anadirMercanciaControlador():string {
        $peso = $this->limpiarCadena($_POST["nueva-mercancia-peso"]);
        $tipoPeso = $this->limpiarCadena($_POST["tipo-peso"]);
        $tipoEstado = $this->limpiarCadena($_POST["nueva-mercancia-tipo-estado"]);
        $descripcion = $this->limpiarCadena($_POST["nueva-mercancia-descripcion"]);

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
        $verificarTipoPeso = "SELECT tipo FROM tipo_peso WHERE tipo = $tipoPeso";
        $verificarTipoPeso = $this->ejecutarConsulta($verificarTipoPeso);

        if ($verificarTipoPeso->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El tipo de peso no existe');
            return $alerta;
        }

        // Verificar tipo estado
        $verificarTipoEstado = "SELECT tipo FROM tipo_estado WHERE tipo = $tipoEstado";
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
}

?>