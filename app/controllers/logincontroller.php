<?php

namespace app\controllers;
use app\models\mainModel;

class loginController extends mainModel {

    // Controlador para loguear usuario
    public function loginUsuarioControlador () {
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
                    echo "<script>window.location.href = '".APP_URL."location/';</script>";
                }
                else {
                    header("Location: ".APP_URL."location/");
                }
            }
            else {
                echo '<script>
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Contraseña incorrecta",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>';
            }
        }
        else {
            echo '<script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Usuario no válido",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
        }

    }

}



?>