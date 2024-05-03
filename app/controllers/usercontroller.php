<?php

namespace app\controllers;
use app\models\mainModel;

class userController extends mainModel
{

    // Controlador para anadir usuarios
    public function anadirUsuarioControlador():string
    {

        $dni = $this->limpiarCadena($_POST["nuevo-trabajador-dni"]);
        $nombre = $this->limpiarCadena($_POST["nuevo-trabajador-nombre"]);
        $apellidos = $this->limpiarCadena($_POST["nuevo-trabajador-apellidos"]);
        $telefono = $this->limpiarCadena($_POST["nuevo-trabajador-telefono"]);
        $correo = $this->limpiarCadena($_POST["nuevo-trabajador-correo"]);
        $fecha_nacimiento = $this->limpiarCadena($_POST["nuevo-trabajador-fecha-nacimiento"]);
        $fecha_inicio = $this->limpiarCadena($_POST["nuevo-trabajador-fecha-inicio"]);
        $cargo = $this->limpiarCadena($_POST["nuevo-trabajador-cargo"]);


        // Verificar que no existe el usuario
        $verificarUsuario = "SELECT dni FROM empleados WHERE dni = '$dni'";
        $verificarUsuario = $this->ejecutarConsulta($verificarUsuario);

        if ($verificarUsuario->rowCount() == 1) {
            $alerta = [
                "tipo" => "limpiar",
                "icono" => "error",
                "titulo" => "El trabajador ya existe"
            ];

            return json_encode($alerta);
        }

        // Verificar dni
        $dni = mb_strtoupper($dni);
        if (!$this->verificarDatos('[0-9]{8}[A-Z]', $dni)) {
            $alerta = [
                "tipo" => "limpiar",
                "icono" => "error",
                "titulo" => "El dni no es válido"
            ];
            return json_encode($alerta);
        }

        // Cambiar formato fechas
        $fecha_nacimiento = str_replace("-", "", $fecha_nacimiento);
        $fecha_inicio = str_replace("-", "", $fecha_inicio);

        // Verificar cargo
        $verificarCargo = "SELECT tipo FROM tipo_cargo where tipo = '$cargo'";
        $verificarCargo = $this->ejecutarConsulta($verificarCargo);

        if ($verificarCargo->rowCount() == 0) {
            $alerta = [
                "tipo" => "limpiar",
                "icono" => "error",
                "titulo" => "El cargo es incorrecto"
            ];

            return json_encode($alerta);
        }

        // Cuenta web
        if (isset($_POST["nuevo-trabajador-cuenta"])) {
            $password = password_hash($dni, PASSWORD_BCRYPT, ["cost" => 10]);
            $datosCuenta = [
                [
                    "campo_nombre" => "dni_empleado",
                    "campo_marcador" => ":dni_empleado",
                    "campo_valor" => $dni
                ],
                [
                    "campo_nombre" => "password",
                    "campo_marcador" => ":password",
                    "campo_valor" => $password
                ]
            ];
        }

        $datosUsuario = [
            [
                "campo_nombre" => "dni",
                "campo_marcador" => ":dni",
                "campo_valor" => $dni
            ],
            [
                "campo_nombre" => "nombre",
                "campo_marcador" => ":nombre",
                "campo_valor" => $nombre
            ],
            [
                "campo_nombre" => "apellidos",
                "campo_marcador" => ":apellidos",
                "campo_valor" => $apellidos
            ],
            [
                "campo_nombre" => "telefono",
                "campo_marcador" => ":telefono",
                "campo_valor" => $telefono
            ],
            [
                "campo_nombre" => "correo",
                "campo_marcador" => ":correo",
                "campo_valor" => $correo
            ],
            [
                "campo_nombre" => "fecha_nacimiento",
                "campo_marcador" => ":fecha_nacimiento",
                "campo_valor" => $fecha_nacimiento
            ],
            [
                "campo_nombre" => "fecha_inicio_empresa",
                "campo_marcador" => ":fecha_inicio_empresa",
                "campo_valor" => $fecha_inicio
            ],
            [
                "campo_nombre" => "cargo",
                "campo_marcador" => ":cargo",
                "campo_valor" => $cargo
            ]
        ];

        $anadirUser = $this->guardarDatos("empleados", $datosUsuario);

        if ($anadirUser->rowCount() == 1) {
            $alerta = [
                "tipo" => "recargar",
                "icono" => "success",
                "titulo" => "Usuario añadido",
                "url" => APP_URL . "trabajadores"
            ];
            if (isset($_POST["nuevo-trabajador-cuenta"])) {
                $anadirCuenta = $this->guardarDatos("cuentas_web", $datosCuenta);
                if ($anadirCuenta->rowCount() == 0) {
                    $alerta = [
                        "tipo" => "recargar",
                        "icono" => "warning",
                        "titulo" => "Fallo al crear la cuenta web",
                        "url" => APP_URL . "trabajadores"
                    ];
                }

            }

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