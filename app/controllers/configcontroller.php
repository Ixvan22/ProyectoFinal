<?php

namespace app\controllers;
use app\models\mainModel;

class configController extends mainModel {
    public function editarUsuarioControlador(string $usuario):string {
        $dni = $this->limpiarCadena($_POST["edit-trabajador-dni"]);
        $nombre = $this->limpiarCadena($_POST["edit-trabajador-nombre"]);
        $apellidos = $this->limpiarCadena($_POST["edit-trabajador-apellidos"]);
        $telefono = $this->limpiarCadena($_POST["edit-trabajador-telefono"]);
        $correo = $this->limpiarCadena($_POST["edit-trabajador-correo"]);
        $fecha_nacimiento = $this->limpiarCadena($_POST["edit-trabajador-fecha-nacimiento"]);
        $fecha_inicio = $this->limpiarCadena($_POST["edit-trabajador-fecha-inicio"]);
        $cargo = $this->limpiarCadena($_POST["nuevo-trabajador-cargo"]);


        // Verificar usuario
        $verificarUsuario = "SELECT dni FROM empleados WHERE dni = '$usuario'";
        $verificarUsuario = $this->ejecutarConsulta($verificarUsuario);

        if ($verificarUsuario->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El trabajador no existe');
            return $alerta;
        }

        $datosUsuario = [];

        if ($dni != '') {
            $dni = mb_strtoupper($dni);
            if (!$this->verificarDatos('[0-9]{8}[A-Z]', $dni)) {
                $alerta = $this->alertController->alertaSimple('error', 'El dni no es válido');
                return $alerta;
            }

            $datosUsuario[] = [
                "campo_nombre" => "dni",
                "campo_marcador" => ":dni",
                "campo_valor" => $dni
            ];
        }
        if ($nombre != '') {
            $datosUsuario[] = [
                "campo_nombre" => "nombre",
                "campo_marcador" => ":nombre",
                "campo_valor" => $nombre
            ];

        }
        if ($apellidos != '') {
            $datosUsuario[] = [
                "campo_nombre" => "apellidos",
                "campo_marcador" => ":apellidos",
                "campo_valor" => $apellidos
            ];

        }
        if ($telefono != '') {
            if (!$this->verificarDatos('[67]{1}[0-9]{8}', $telefono)) {
                $alerta = $this->alertController->alertaSimple('error', 'El teléfono no es válido');
                return $alerta;
            }
            $datosUsuario[] = [
                "campo_nombre" => "telefono",
                "campo_marcador" => ":telefono",
                "campo_valor" => $telefono
            ];
        }
        if ($correo != '') {
            $datosUsuario[] = [
                "campo_nombre" => "correo",
                "campo_marcador" => ":correo",
                "campo_valor" => $correo
            ];

        } 
        if ($fecha_nacimiento != '') {
            $fecha_nacimiento = str_replace("-", "", $fecha_nacimiento);
            $datosUsuario[] = [
                "campo_nombre" => "fecha_nacimiento",
                "campo_marcador" => ":fecha_nacimiento",
                "campo_valor" => $fecha_nacimiento
            ];
        }
        if ($fecha_inicio != '') {
            $fecha_inicio = str_replace("-", "", $fecha_inicio);
            $datosUsuario[] = [
                "campo_nombre" => "fecha_inicio_empresa",
                "campo_marcador" => ":fecha_inicio_empresa",
                "campo_valor" => $fecha_inicio
            ];
        }
        if ($cargo != '') {
            $verificarCargo = "SELECT tipo FROM tipo_cargo where tipo = '$cargo'";
            $verificarCargo = $this->ejecutarConsulta($verificarCargo);
    
            if ($verificarCargo->rowCount() == 0) {
                $alerta = $this->alertController->alertaSimple('error', 'El cargo es incorrecto');
                return $alerta;
            }

            $datosUsuario[] =             [
                "campo_nombre" => "cargo",
                "campo_marcador" => ":cargo",
                "campo_valor" => $cargo
            ];
        }

        $actualizarUser = $this->actualizarDatos('empleados', $datosUsuario, 'dni = "'.$usuario.'"');

        if ($actualizarUser->rowCount() == 1) {
            if (isset($dni) && $dni != '') $usuario = $dni;
            $alerta = $this->alertController->alertaRecargar('success', 'Usuario actualizado', APP_URL.'configuracion/'.$usuario);

        } else {
            $alerta = $this->alertController->alertaSimple('error', 'Error al actualizar el usuario');
        }

        return $alerta;
    }
}