<?php

spl_autoload_register();

require_once "../config/app.php";
require_once "../views/inc/session_start.php";
require_once "../controllers/alertcontroller.php";
require_once "../models/mainmodel.php";
require_once "../controllers/usercontroller.php";


$insUsuario = new \app\controllers\userController();

$datos = file_get_contents("php://input");

$datos = json_decode($datos, true);

$insUsuario->anadirJornadaControlador($datos[0], $datos[1], $_SESSION["empleado"]);

?>
