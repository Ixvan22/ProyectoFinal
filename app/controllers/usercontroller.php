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
            $alerta = $this->alertController->alertaSimple('error', 'El trabajador ya existe');
            return $alerta;
        }

        // Verificar dni
        $dni = mb_strtoupper($dni);
        if (!$this->verificarDatos('[0-9]{8}[A-Z]', $dni)) {
            $alerta = $this->alertController->alertaSimple('error', 'El dni no es válido');
            return $alerta;
        }

        // Verificar telefono
        if (!$this->verificarDatos('[67]{1}[0-9]{8}', $telefono)) {
            $alerta = $this->alertController->alertaSimple('error', 'El teléfono no es válido');
            return $alerta;
        }

        // Cambiar formato fechas
        $fecha_nacimiento = str_replace("-", "", $fecha_nacimiento);
        $fecha_inicio = str_replace("-", "", $fecha_inicio);

        // Verificar cargo
        $verificarCargo = "SELECT tipo FROM tipo_cargo where tipo = '$cargo'";
        $verificarCargo = $this->ejecutarConsulta($verificarCargo);

        if ($verificarCargo->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El cargo es incorrecto');
            return $alerta;
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
            $alerta = $this->alertController->alertaRecargar('success', 'Usuario añadido', APP_URL.'trabajadores');
            if (isset($_POST["nuevo-trabajador-cuenta"])) {
                $alerta = $this->anadirCuentaControlador($dni);

            }

        } else {
            $alerta = $this->alertController->alertaSimple('error', 'Error al añadir el usuario');
        }

        return $alerta;
    }

    public function anadirCuentaControlador (string $dni) {
        $verificarCuenta = "SELECT dni_empleado FROM cuentas_web WHERE dni_empleado = '$dni'";
        $verificarCuenta = $this->ejecutarConsulta($verificarCuenta);

        if ($verificarCuenta->rowCount() == 1) {
            $alerta = $this->alertController->alertaSimple('error', 'La cuenta ya existe');
            return $alerta;
        }

        $verificarCuenta = "SELECT dni FROM empleados WHERE dni = '$dni'";
        $verificarCuenta = $this->ejecutarConsulta($verificarCuenta);
        if ($verificarCuenta->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'No existe el trabajador');
            return $alerta;
        }

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
        $anadirCuenta = $this->guardarDatos("cuentas_web", $datosCuenta);
        if ($anadirCuenta->rowCount() == 0) {
            $alerta = $this->alertController->alertaRecargar('warning', 'Fallo al crear la cuenta web', APP_URL.'trabajadores');
        }
        else {
            $alerta = $this->alertController->alertaRecargar('success', 'Cuenta añadida', APP_URL.'trabajadores');
        }
        return $alerta;
    }

    public function eliminarCuentaControlador (string $dni) {
        // Verificar cuenta web
        $consultaCuenta = "SELECT dni_empleado FROM cuentas_web WHERE dni_empleado = '$dni'";
        $consultaCuenta = $this->ejecutarConsulta($consultaCuenta);

        if ($consultaCuenta->rowCount() == 1) {
            $deleteCuenta = "DELETE FROM cuentas_web WHERE dni_empleado = '$dni'";
            $deleteCuenta = $this->ejecutarConsulta($deleteCuenta);
            if ($deleteCuenta->rowCount() == 0) {
                $alerta = $this->alertController->alertaSimple('error', 'Fallo al eliminar la cuenta');
                return $alerta;
            }
        }

        $deleteUser = "DELETE FROM empleados WHERE dni = '$dni'";
        $deleteUser = $this->ejecutarConsulta($deleteUser);

        if ($deleteUser->rowCount() == 1) {
            $alerta = $this->alertController->alertaRecargar('success', 'Trabajador eliminado', APP_URL.'trabajadores');
        }
        else {
            $alerta = $this->alertController->alertaSimple('warning', 'No existe el trabajador');
        }
        return $alerta;

    }

    public function listarUsuariosControlador():string {
        $contenido = '';

        $consultaEmpleados = "SELECT * FROM empleados ORDER BY fecha_inicio_empresa";
        $consultaEmpleados = $this->ejecutarConsulta($consultaEmpleados);
        $consultaCuentas = "SELECT dni_empleado FROM cuentas_web";
        $consultaCuentas = $this->consultaToArrayUnico($consultaCuentas);

        while ($empleado = $consultaEmpleados->fetch(\PDO::FETCH_ASSOC)) {
            $contenido .= '<tr class="align-middle">
                            <th scope="row">'.$empleado["dni"].'</th>
                            <td>'.$empleado["nombre"].'</td>
                            <td>'.$empleado["apellidos"].'</td>
                            <td>'.$empleado["telefono"].'</td>
                            <td>'.$empleado["correo"].'</td>
                            <td>'.$empleado["fecha_nacimiento"].'</td>
                            <td>'.$empleado["fecha_inicio_empresa"].'</td>
                            <td>'.$empleado["cargo"].'</td>';
            if (in_array($empleado['dni'], $consultaCuentas)) {
                $contenido .= '<td class="d-flex"><a href="'.APP_URL.'trabajadores/eliminarCuenta/'.$empleado["dni"].'" 
                class="btn btn-danger mx-2">Eliminar trabajador</a></td>';
            }
            else {
                $contenido .= '<td class="d-flex"><a href="'.APP_URL.'trabajadores/anadirCuenta/'.$empleado["dni"].'" 
                class="btn btn-secondary">Crear cuenta</a>
                <a href="'.APP_URL.'trabajadores/eliminarCuenta/'.$empleado["dni"].'" class="btn btn-danger mx-2">Eliminar trabajador</a></td>';
            }
            $contenido .= '</tr>';
        }

        return $contenido;
    }

    public function listarCargosControlador():string {
        $contenido = '<select class="form-select w-75" id="nuevo-trabajador-cargo" name="nuevo-trabajador-cargo" autocomplete="none">
        <option selected value="default"></option>';

        $consultaCargo = 'SELECT * FROM tipo_cargo ORDER BY tipo';
        $consultaCargo = $this->ejecutarConsulta($consultaCargo);

        while ($result = $consultaCargo->fetch(\PDO::FETCH_ASSOC)) {
            $contenido .= '<option value="'.$result["tipo"].'">'.ucfirst(mb_strtolower($result["nombre"])).'</option>';
        }
        $contenido .= '</select>';

        return $contenido;
    }
}
?>