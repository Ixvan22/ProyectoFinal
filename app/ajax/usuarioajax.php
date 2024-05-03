<?php


require_once "../config/app.php";
require_once "../views/inc/session_start.php";
require_once "../models/mainmodel.php";
require_once "../controllers/usercontroller.php";

$insUsusario = new \app\controllers\userController();

if (isset($_POST["anadir-trabajador"])) {
    echo $insUsusario->anadirUsuarioControlador();
}
//elseif (isset($_POST["eliminar_usuario"])) {
//    echo $insUsusario->eliminarUsuarioControlador();
//}


?>