<?php

spl_autoload_register();
require_once "./app/config/app.php";

if (isset($_GET["views"])) {
    $url = explode("/", $_GET["views"]);
}
else {
    $url = ["index"];
}

use app\controllers\viewsController;
use app\controllers\loginController;
use app\controllers\userController;
use app\controllers\configController;
use app\controllers\clienteController;
use app\controllers\vehiculoController;
use app\controllers\mercanciaController;

require_once "./app/views/inc/session_start.php";

$insLogin = new loginController();
$insUsusario = new userController();
$insConfig = new configController();
$insCliente = new clienteController();
$insVehiculo = new vehiculoController();
$insMercancia = new mercanciaController();
$viewsController = new viewsController();
$vista = $viewsController->obtenerVistasControlador($url[0]);


// TODO REALIZAR COMPROBACIONES

require_once $vista;

?>