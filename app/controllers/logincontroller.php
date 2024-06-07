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

                // Variable de sesión para mantener la sesión iniciada
                $_SESSION["empleado"] = $check_usuario["dni_empleado"];

                $consultaTipoEmpleado = "SELECT cargo FROM empleados WHERE dni = '".$check_usuario["dni_empleado"]."'";
                $consultaTipoEmpleado = $this->ejecutarConsulta($consultaTipoEmpleado);
                $consultaTipoEmpleado = $consultaTipoEmpleado->fetch(\PDO::FETCH_ASSOC);
                
                // Variable de sesión para conocer el cargo del empleado
                $_SESSION["cargo_empleado"] = $consultaTipoEmpleado["cargo"];

                $this->generarLoginLog();

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

    public function generarLoginLog() {
        $file = fopen('login.log', 'a');
        $fechaActual = getdate();
        $fechaActual = $fechaActual["year"].str_pad($fechaActual["mon"], 2, 0, STR_PAD_LEFT).
            str_pad($fechaActual["mday"], 2, 0, STR_PAD_LEFT).';'.
            str_pad($fechaActual["hours"], 2, 0, STR_PAD_LEFT).
            str_pad($fechaActual["minutes"], 2, 0, STR_PAD_LEFT).
            str_pad($fechaActual["seconds"], 2, 0, STR_PAD_LEFT);

        fwrite($file, $_SESSION["empleado"].';'.$fechaActual.PHP_EOL);
        fclose($file);
    }

}



?>