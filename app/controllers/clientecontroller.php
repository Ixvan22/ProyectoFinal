<?php

namespace app\controllers;
use app\models\mainModel;

class clienteController extends mainModel {
    public function anadirClienteControlador():string {
        $dni = $this->limpiarCadena($_POST["nuevo-cliente-dni"]);
        $nombre = $this->limpiarCadena($_POST["nuevo-cliente-nombre"]);
        $apellidos = $this->limpiarCadena($_POST["nuevo-cliente-apellidos"]);
        $telefono = $this->limpiarCadena($_POST["nuevo-cliente-telefono"]);
        $correo = $this->limpiarCadena($_POST["nuevo-cliente-correo"]);

        // Verificar que no existe el usuario
        $verificarCliente = "SELECT dni FROM usuarios WHERE dni = '$dni'";
        $verificarCliente = $this->ejecutarConsulta($verificarCliente);

        if ($verificarCliente->rowCount() == 1) {
            $alerta = $this->alertController->alertaSimple('error', 'El cliente ya existe');
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

        $datosCliente = [
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
            ]
        ];

        $anadirCliente = $this->guardarDatos("usuarios", $datosCliente);

        if ($anadirCliente->rowCount() == 1) {
            if (isset($_POST["anadir-mercancia"])) {
                return true;
            }
            $alerta = $this->alertController->alertaRecargar('success', 'Cliente añadido', APP_URL.'clientes');
            

        } else {
            if (isset($_POST["anadir-mercancia"])) {
                return false;
            }
            $alerta = $this->alertController->alertaSimple('error', 'Error al añadir el cliente');
        }

        return $alerta;
    }

    public function listarClientesControlador():string {
        $contenido = '';

        $consultaClientes = "SELECT * FROM usuarios ORDER BY nombre";
        $consultaClientes = $this->ejecutarConsulta($consultaClientes);

        while ($cliente = $consultaClientes->fetch(\PDO::FETCH_ASSOC)) {
            $contenido .= '<div class="col-12">
                            <div class="-card-clientes py-3 px-1">
                                <p class="p-0 m-0">DNI: <span id="clientes-datos-dni">'.$cliente["dni"].'</span></p>
                                <p class="p-0 m-0">Nombre: <span id="clientes-datos-nombre">'.$cliente["nombre"].'</span></p>
                                <p class="p-0 m-0">Apellidos: <span id="clientes-datos-apellidos">'.$cliente["apellidos"].'</span></p>
                                <p class="p-0 m-0">Teléfono: <span id="clientes-datos-telefono">'.$cliente["telefono"].'</span></p>
                                <p class="p-0 m-0">Correo: <span id="clientes-datos-correo">'.$cliente["correo"].'</span></p>
                                <div class="d-flex gap-1">
                                    <a href="'.APP_URL.'clientes/eliminarCliente/'.$cliente["dni"].'" class="btn btn-danger"><i class="fa-solid fa-x"></i></a>
                                </div>
                            </div>
                        </div>';
        }

        return $contenido;
    }

    public function eliminarClienteControlador (string $dni):string {
        $consultaCliente = "SELECT dni FROM usuarios WHERE dni = '$dni'";
        $consultaCliente = $this->ejecutarConsulta($consultaCliente);

        if ($consultaCliente->rowCount() == 1) {
            $deleteCliente = "DELETE FROM usuarios WHERE dni = '$dni'";
            $deleteCliente = $this->ejecutarConsulta($deleteCliente);
            if ($deleteCliente->rowCount() == 0) {
                $alerta = $this->alertController->alertaSimple('error', 'Fallo al eliminar el usuario');
                return $alerta;
            }
            $alerta = $this->alertController->alertaRecargar('success', 'Cliente eliminado', APP_URL.'clientes');
        }
        else {
            $alerta = $this->alertController->alertaSimple('error', 'No existe el cliente');
        }

        return $alerta;
    }

    public function listarClientesMercanciaControlador():string {
        $contenido = '<select class="form-select w-75" name="mercancia-cliente-existente" id="mercancia-cliente-existente">
                        <option selected></option>';

        $consultaClientes = "SELECT * FROM usuarios ORDER BY nombre";
        $consultaClientes = $this->ejecutarConsulta($consultaClientes);

        while ($cliente = $consultaClientes->fetch(\PDO::FETCH_ASSOC)) {
            $contenido .= '<option value="'.$cliente["dni"].'">'.$cliente["dni"].'</option>';
        }

        $contenido .= '</select>';

        return $contenido;
    }
    
}

?>