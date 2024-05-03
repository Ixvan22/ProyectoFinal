<?php

namespace app\controllers;
use app\models\mainModel;

class userController extends mainModel
{

    // Controlador para anadir usuarios
    public function anadirUsuarioControlador()
    {

        $usuario = $this->limpiarCadena($_POST["usuario_usuario"]);
        $clave1 = $this->limpiarCadena($_POST["usuario_clave1"]);
        $clave2 = $this->limpiarCadena($_POST["usuario_clave2"]);
        $tipo = $this->limpiarCadena($_POST["usuario_tipo"]);


        // Verificar que no existe el usuario
        $verificarUsuario = "SELECT usuario_usuario FROM usuario WHERE usuario_usuario = '$usuario'";
        $verificarUsuario = $this->ejecutarConsulta($verificarUsuario);

        if ($verificarUsuario->rowCount() == 1) {
            $alerta = [
                "tipo" => "limpiar",
                "icono" => "error",
                "titulo" => "El usuario ya existe"
            ];

            return json_encode($alerta);
        }

        // Verificar claves
        if ($clave1 != $clave2) {
            $alerta = [
                "tipo" => "limpiar",
                "icono" => "error",
                "titulo" => "Las claves no coinciden"
            ];

            return json_encode($alerta);
        }

        $clave = password_hash($clave1, PASSWORD_BCRYPT, ["cost" => 10]);

        // Verificar tipo
        if ($tipo != "admin" && $tipo != "user") {
            $alerta = [
                "tipo" => "limpiar",
                "icono" => "error",
                "titulo" => "El tipo no es correcto"
            ];

            return json_encode($alerta);
        }

        $datosUsuario = [
            [
                "campo_nombre" => "usuario_usuario",
                "campo_marcador" => ":Usuario",
                "campo_valor" => $usuario
            ],
            [
                "campo_nombre" => "usuario_clave",
                "campo_marcador" => ":Clave",
                "campo_valor" => $clave
            ],
            [
                "campo_nombre" => "usuario_tipo",
                "campo_marcador" => ":Tipo",
                "campo_valor" => $tipo
            ]
        ];

        $anadirUser = $this->guardarDatos("usuario", $datosUsuario);

        if ($anadirUser->rowCount() > 0) {
            $alerta = [
                "tipo" => "recargar",
                "icono" => "success",
                "titulo" => "Usuario añadido",
                "url" => APP_URL . "addUser/"
            ];
        } else {
            $alerta = [
                "tipo" => "limpiar",
                "icono" => "error",
                "titulo" => "Error al añadir el usuario"
            ];
        }

        return json_encode($alerta);

    }
}
?>