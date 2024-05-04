<?php

namespace app\controllers;
use app\models\mainModel;

class loginController extends mainModel {

    // Controlador para loguear usuario
    public function loginUsuarioControlador ():string {
        $dni = $this->limpiarCadena($_POST["login-dni"]);
        $clave = $this->limpiarCadena($_POST["login-password"]);

        // Verificar que el usuario exista
        $check_usuario = $this->ejecutarConsulta("SELECT * FROM cuentas_web WHERE dni_empleado = '$dni'");

        if ($check_usuario->rowCount() == 1) {
            $check_usuario = $check_usuario->fetch();

            if ($check_usuario["dni_empleado"] == $dni && password_verify($clave, $check_usuario["password"])) {

                $_SESSION["empleado"] = $check_usuario["dni_empleado"];
                $_SESSION["empleado_cargo"] = $check_usuario["cargo"];

                // Enviar al dashboard de pedidos si los datos son correctos
                // TODO CAMBIAR LOCATION
                if (headers_sent()) {
                    return "<script>window.location.href = '".APP_URL."gestionPrincipal';</script>";
                }
                else {
                    header("Location: ".APP_URL."gestionPrincipal");
                }
            }
            else {
                return $this->alertController->alertaSimple('error', 'Contraseña incorrecta');
            }
        }
        else {
            return $this->alertController->alertaSimple('error', 'Usuario no válido');
        }
        return '';

    }

}



?>