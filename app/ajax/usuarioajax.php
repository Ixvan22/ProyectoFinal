<?php

spl_autoload_register();

require_once "../config/app.php";
require_once "../views/inc/session_start.php";

use app\controllers\userController;


$insUsusario = new userController();

if (isset($_POST["anadir-trabajador"])) {
    echo $insUsusario->anadirUsuarioControlador();
}
//elseif (isset($_POST["eliminar_usuario"])) {
//    echo $insUsusario->eliminarUsuarioControlador();
//}


?>