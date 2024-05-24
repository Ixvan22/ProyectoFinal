<?php

namespace app\controllers;
use app\models\mainModel;

class userController extends mainModel {
    // Método para añadir usuarios
    public function anadirUsuarioControlador():string {
        $dni = $this->limpiarCadena($_POST["nuevo-trabajador-dni"]);
        $nombre = $this->limpiarCadena($_POST["nuevo-trabajador-nombre"]);
        $apellidos = $this->limpiarCadena($_POST["nuevo-trabajador-apellidos"]);
        $telefono = $this->limpiarCadena($_POST["nuevo-trabajador-telefono"]);
        $correo = $this->limpiarCadena($_POST["nuevo-trabajador-correo"]);
        $fecha_nacimiento = $this->limpiarCadena($_POST["nuevo-trabajador-fecha-nacimiento"]);
        $fecha_inicio = $this->limpiarCadena($_POST["nuevo-trabajador-fecha-inicio"]);
        $cargo = $this->limpiarCadena($_POST["trabajador-cargo"]);


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

        // Datos para insertar el usuario
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

    // Método para añadir cuentas web
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

    // Método para eliminar empleados y cuentas
    public function eliminarCuentaControlador (string $dni, bool $empleado):string {
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

        if ($empleado) {
            $deleteUser = "DELETE FROM empleados WHERE dni = '$dni'";
            $deleteUser = $this->ejecutarConsulta($deleteUser);

            if ($deleteUser->rowCount() == 1) {
                $alerta = $this->alertController->alertaRecargar('success', 'Trabajador eliminado', APP_URL.'trabajadores');
            }
            else {
                $alerta = $this->alertController->alertaSimple('error', 'Fallo al eliminar el trabajador');
            }
        }
        else {
            $alerta = $this->alertController->alertaRecargar('success', 'Cuenta eliminada', APP_URL.'usuarios');
        }

        return $alerta;

    }

    // Método para listar empleados
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
                class="btn btn-danger mx-2">Eliminar trabajador</a>
                <a href="'.APP_URL.'configuracion/'.$empleado["dni"].'" class="btn btn-success mx-2">Editar</a></td></td>';
            }
            else {
                $contenido .= '<td class="d-flex"><a href="'.APP_URL.'trabajadores/anadirCuenta/'.$empleado["dni"].'" 
                class="btn btn-secondary">Crear cuenta</a>
                <a href="'.APP_URL.'trabajadores/eliminarEmpleado/'.$empleado["dni"].'" class="btn btn-danger mx-2">Eliminar trabajador</a>
                <a href="'.APP_URL.'configuracion/'.$empleado["dni"].'" class="btn btn-success mx-2">Editar</a></td></td>';
            }
            $contenido .= '</tr>';
        }

        return $contenido;
    }

    // Método para listar cuentas web
    public function listarCuentasControlador():string {
        $contenido = '';

        $consultaCuentas = "SELECT dni_empleado FROM cuentas_web";
        $consultaCuentas = $this->consultaToArrayUnico($consultaCuentas);

        foreach ($consultaCuentas as $cuenta) {
            $empleado = "SELECT * FROM empleados WHERE dni = '$cuenta'";
            $empleado = $this->ejecutarConsulta($empleado);
            $empleado = $empleado->fetch(\PDO::FETCH_ASSOC);

            $contenido .= '<tr class="align-middle">
                            <th scope="row">'.$empleado["dni"].'</th>
                            <td>'.$empleado["nombre"].'</td>
                            <td>'.$empleado["apellidos"].'</td>
                            <td>'.$empleado["telefono"].'</td>
                            <td>'.$empleado["correo"].'</td>
                            <td>'.$empleado["fecha_nacimiento"].'</td>
                            <td>'.$empleado["fecha_inicio_empresa"].'</td>
                            <td>'.$empleado["cargo"].'</td>
                            <td class="d-flex"><a href="'.APP_URL.'usuarios/eliminarCuenta/'.$empleado["dni"].'" class="btn btn-danger">Eliminar</a>
                            <a href="" class="btn btn-success mx-2">Editar</a></td>';
        }

        return $contenido;
    }

    // Método para listar encabezado navbar
    public function listarUsuarioNavbarControlador(string $dni):string {

        $consultaUsuario = "SELECT nombre, cargo FROM empleados where dni = '$dni'";
        $consultaUsuario = $this->ejecutarConsulta($consultaUsuario);
        $consultaUsuario = $consultaUsuario->fetch(\PDO::FETCH_ASSOC);

        $consultaCargo = "SELECT nombre FROM tipo_cargo WHERE tipo = ".$consultaUsuario['cargo'];
        $consultaCargo = $this->ejecutarConsulta($consultaCargo);
        $consultaCargo = $consultaCargo->fetch(\PDO::FETCH_ASSOC);

        $contenido = '<h4>'.$consultaUsuario["nombre"].' ('.ucfirst(mb_strtolower($consultaCargo["nombre"])).')</h4>';

        return $contenido;
    }

    // Método para añadir jornada de un usuario, usa ajax/jorandaajax.php y workday.js
    public function anadirJornadaControlador(array $horaInicio, array $horaFin, string $dni):bool {
        $datosJornada = [
            [
                "campo_nombre" => "dni_empleado",
                "campo_marcador" => ":dni_empleado",
                "campo_valor" => $dni
            ],
            [
                "campo_nombre" => "fecha_jornada",
                "campo_marcador" => ":fecha_jornada",
                "campo_valor" => $horaInicio[0]
            ],
            [
                "campo_nombre" => "hora_entrada",
                "campo_marcador" => ":hora_entrada",
                "campo_valor" => $horaInicio[1]
            ],
            [
                "campo_nombre" => "hora_salida",
                "campo_marcador" => ":hora_salida",
                "campo_valor" => $horaFin[1]
            ],
        ];
        $anadirJornada = $this->guardarDatos("jornada_empleados", $datosJornada);
        if ($anadirJornada->rowCount() == 0) {
            return false;
        }
        return true;
    }

    // Método para listar jornadas de un empleado
    public function listarJornadaUsuarioControlador():string {
        $contenido = '';

        $consultaJornada = "SELECT * FROM jornada_empleados WHERE dni_empleado = '".$_SESSION["empleado"]."' ORDER BY fecha_jornada DESC LIMIT 10";
        $consultaJornada = $this->ejecutarConsulta($consultaJornada);

        while ($jornada = $consultaJornada->fetch(\PDO::FETCH_ASSOC)) {
            $fecha = substr($jornada["fecha_jornada"], 6, 2)."/".
                substr($jornada["fecha_jornada"], 4, 2)."/".
                substr($jornada["fecha_jornada"], 0, 4);

            $contenido .= '
            <tr>
                <td>'.$fecha.'</td>
                <td>'.$jornada["hora_entrada"].'</td>
                <td>'.$jornada["hora_salida"].'</td>
            </tr>
            ';
        }
        return $contenido;

    }

    // Método para listar planificación de los empleados el día actual
    public function listarPlanificacionUsuarioControlador():string {
        $contenido = '';

        $fecha = getdate();

        $fechaActual = $fecha["year"].str_pad($fecha["mon"], 2, 0, STR_PAD_LEFT).str_pad($fecha["mday"], 0, 2, STR_PAD_LEFT);

        $consultaPlanifiacion = "SELECT * FROM planificacion_empleados WHERE empleado = '".$_SESSION["empleado"]."' AND fecha = '$fechaActual'";
        $consultaPlanifiacion = $this->ejecutarConsulta($consultaPlanifiacion);

        while ($planificacion = $consultaPlanifiacion->fetch(\PDO::FETCH_ASSOC)) {
            $fecha = substr($planificacion["fecha"], 6, 2)."/".
                substr($planificacion["fecha"], 4, 2)."/".
                substr($planificacion["fecha"], 0, 4);
            $contenido .= '
            <tr>
                <td>'.$fecha.'</td>
                <td>'.$planificacion["descripcion"].'</td>
            </tr>
            ';
        }

        return $contenido;
    }

    // Método para añadir planificación de un usuario
    public function anadirPlanificacionUsuarioControlador():string {
        $fecha = $this->limpiarCadena($_POST["nueva-planificacion-fecha"]);
        $dni = $this->limpiarCadena($_POST["dni-cliente"]);
        $descripcion = $this->limpiarCadena($_POST["nueva-planificacion-descripcion"]);

        // Formato fecha
        $fecha = str_replace("-", "", $fecha);

        $verificarEmpleado = "SELECT dni_empleado FROM cuentas_web WHERE dni_empleado = '$dni'";
        $verificarEmpleado = $this->ejecutarConsulta($verificarEmpleado);

        if ($verificarEmpleado->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El trabajador no existe / no tiene cuenta');
            return $alerta;
        }

        if ($fecha == '') {
            $alerta = $this->alertController->alertaSimple('error', 'La fecha es obligatoria');
            return $alerta;
        }

        if ($descripcion == '') {
            $alerta = $this->alertController->alertaSimple('error', 'La descripción es obligatoria');
            return $alerta;
        }

        $datosPlanificacion = [
            [
                "campo_nombre" => "fecha",
                "campo_marcador" => ":fecha",
                "campo_valor" => $fecha
            ],
            [
                "campo_nombre" => "empleado",
                "campo_marcador" => ":empleado",
                "campo_valor" => $dni
            ],
            [
                "campo_nombre" => "descripcion",
                "campo_marcador" => ":descripcion",
                "campo_valor" => $descripcion
            ]
        ];

        $anadirPlanificacion = $this->guardarDatos("planificacion_empleados", $datosPlanificacion);

        if ($anadirPlanificacion->rowCount() == 1) {
            $alerta = $this->alertController->alertaRecargar('success', 'Planificación añadida', APP_URL.'gestionPrincipal');
        }
        else {
            $alerta = $this->alertController->alertaSimple('error', 'Fallo al añadir la planificación');
        }
        return $alerta;
    }
}
?>