<?php

namespace app\controllers;
use app\models\mainModel;
use app\controllers\tiposController;

class configController extends mainModel {
    // Método para editar empleados
    public function editarUsuarioControlador(string $usuario):string {
        $nombre = $this->limpiarCadena($_POST["edit-trabajador-nombre"]);
        $apellidos = $this->limpiarCadena($_POST["edit-trabajador-apellidos"]);
        $telefono = $this->limpiarCadena($_POST["edit-trabajador-telefono"]);
        $correo = $this->limpiarCadena($_POST["edit-trabajador-correo"]);
        $fecha_nacimiento = $this->limpiarCadena($_POST["edit-trabajador-fecha-nacimiento"]);
        $fecha_inicio = $this->limpiarCadena($_POST["edit-trabajador-fecha-inicio"]);
        $cargo = $this->limpiarCadena($_POST["trabajador-cargo"]);
        $password = $this->limpiarCadena($_POST["edit-trabajador-password"]);


        // Verificar usuario
        $verificarUsuario = "SELECT * FROM empleados WHERE dni = '$usuario'";
        $verificarUsuario = $this->ejecutarConsulta($verificarUsuario);

        if ($verificarUsuario->rowCount() == 0) {
            $alerta = $this->alertController->alertaSimple('error', 'El trabajador no existe');
            return $alerta;
        }

        $verificarUsuario = $verificarUsuario->fetch(\PDO::FETCH_ASSOC);

        $datosUsuario = [];

        // Comprobacicón si ha modificado algún campo para actualizar
        if ($nombre != $verificarUsuario["nombre"] && $nombre != '') {
            $datosUsuario[] = [
                "campo_nombre" => "nombre",
                "campo_marcador" => ":nombre",
                "campo_valor" => $nombre
            ];
        }

        if ($apellidos != $verificarUsuario["apellidos"] && $apellidos != '') {
            $datosUsuario[] = [
                "campo_nombre" => "apellidos",
                "campo_marcador" => ":apellidos",
                "campo_valor" => $apellidos
            ];
        }

        if ($telefono != $verificarUsuario["telefono"] && $telefono != '') {
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

        if ($correo != $verificarUsuario["correo"] && $correo != '') {
            $datosUsuario[] = [
                "campo_nombre" => "correo",
                "campo_marcador" => ":correo",
                "campo_valor" => $correo
            ];

        }

        $fecha_nacimiento = str_replace("-", "", $fecha_nacimiento);
        if ($fecha_nacimiento != $verificarUsuario["fecha_nacimiento"] && $fecha_nacimiento != '') {
            $datosUsuario[] = [
                "campo_nombre" => "fecha_nacimiento",
                "campo_marcador" => ":fecha_nacimiento",
                "campo_valor" => $fecha_nacimiento
            ];
        }

        $fecha_inicio = str_replace("-", "", $fecha_inicio);
        if ($fecha_inicio != $verificarUsuario["fecha_inicio_empresa"] && $fecha_inicio != '') {
            $datosUsuario[] = [
                "campo_nombre" => "fecha_inicio_empresa",
                "campo_marcador" => ":fecha_inicio_empresa",
                "campo_valor" => $fecha_inicio
            ];
        }

        if ($cargo != $verificarUsuario["cargo"] && $_SESSION["cargo_empleado"] == 1) {
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

        // Verificar si va a modificar la contraseña de la cuenta
        $datosCuentaUsuario = [];
        if ($password != '') {
            $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);
            $datosCuentaUsuario[] = [
                    "campo_nombre" => "password",
                    "campo_marcador" => ":password",
                    "campo_valor" => $password
                ];

            $actualizarPassword = $this->actualizarDatos("cuentas_web", $datosCuentaUsuario, 'dni_empleado = "'.$usuario.'"');
        }

        if (count($datosUsuario) <= 0 && count($datosCuentaUsuario) <= 0) {
            $alerta = $this->alertController->alertaSimple('error', 'No se ha seleccionado nada para actualizar');
            return $alerta;
        }

        if (count($datosCuentaUsuario) > 0) {
            if ($actualizarPassword->rowCount() == 1) {
                $alerta = $this->alertController->alertaRecargar('success', 'Contraseña actualizada', APP_URL.'configuracion/'.$usuario);
            }
        }

        if (count($datosUsuario) > 0) {
            $actualizarUser = $this->actualizarDatos('empleados', $datosUsuario, 'dni = "'.$usuario.'"');
            if ($actualizarUser->rowCount() == 1) {
                $alerta = $this->alertController->alertaRecargar('success', 'Usuario actualizado', APP_URL.'configuracion/'.$usuario);

            } else {
                $alerta = $this->alertController->alertaSimple('error', 'Error al actualizar el usuario');
            }
        }


        return $alerta;
    }

    // Método para mostrar formulario de configuración
    public function listarFormConfigControlador(string $dni):string {
        $contenido = '';

        $usuario = "SELECT * FROM empleados WHERE dni = '$dni'";
        $usuario = $this->ejecutarConsulta($usuario);
        if ($usuario->rowCount() == 1) $usuario = $usuario->fetch(\PDO::FETCH_ASSOC);
        else {
            $contenido = '<h5>No existe el trabajador seleccionado</h5>';
            return $contenido;
        }

        $fecha_nacimiento = substr($usuario["fecha_nacimiento"], 0, 4)."-".substr($usuario["fecha_nacimiento"], 4, 2)."-".
            substr($usuario["fecha_nacimiento"], 6, 2);
        $fecha_inicio_empresa = substr($usuario["fecha_inicio_empresa"], 0, 4)."-".substr($usuario["fecha_inicio_empresa"], 4, 2)."-".
            substr($usuario["fecha_inicio_empresa"], 6, 2);

        $insTipos = new tiposController();

        $contenido .= '
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-dni">DNI:</label>
                    <input type="text" class="w-75 form-control" id="edit-trabajador-dni" 
                    name="edit-trabajador-dni" autocomplete="none" value="'.$usuario["dni"].'" disabled/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-nombre">Nombre:</label>
                    <input type="text" class="w-75 form-control" id="edit-trabajador-nombre" 
                    name="edit-trabajador-nombre" autocomplete="none" value="'.$usuario["nombre"].'"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-apellidos">Apellidos:</label>
                    <input type="text" class="w-75 form-control" id="edit-trabajador-apellidos" 
                    name="edit-trabajador-apellidos" autocomplete="none" value="'.$usuario["apellidos"].'"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-telefono">Teléfono:</label>
                    <input type="number" class="w-75 form-control" id="edit-trabajador-telefono" 
                    name="edit-trabajador-telefono" autocomplete="none" value="'.$usuario["telefono"].'"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-correo">Correo:</label>
                    <input type="email" class="w-75 form-control" id="edit-trabajador-correo" 
                    name="edit-trabajador-correo" autocomplete="none" value="'.$usuario["correo"].'"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-cargo">Cargo:</label>
                    '.$insTipos->listarCargosControlador($usuario["cargo"]).'
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-fecha-nacimiento">Fecha nacimiento:</label>
                    <input type="date" class="w-75 form-control" id="edit-trabajador-fecha-nacimiento" 
                    name="edit-trabajador-fecha-nacimiento" autocomplete="none" value="'.$fecha_nacimiento.'"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-fecha-inicio">Fecha inicio empresa:</label>
                    <input type="date" class="w-75 form-control" id="edit-trabajador-fecha-inicio" 
                    name="edit-trabajador-fecha-inicio" autocomplete="none" value="'.$fecha_inicio_empresa.'"/>
                </div>
        ';

        // Listar input password si tiene cuenta
        $verificarCuenta = "SELECT * FROM cuentas_web WHERE dni_empleado = '".$usuario["dni"]."'";
        $verificarCuenta = $this->ejecutarConsulta($verificarCuenta);
        if ($verificarCuenta->rowCount() == 1) {
            $contenido .= '
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-password">Contraseña:</label>
                    <input type="password" class="w-75 form-control" id="edit-trabajador-password" 
                    name="edit-trabajador-password" autocomplete="none"/>
                </div>
            ';
        }

        return $contenido;
    }
}