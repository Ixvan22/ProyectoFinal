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
require_once "./app/views/inc/session_start.php";


$viewsController = new viewsController();
$vista = $viewsController->obtenerVistasControlador($url[0]);

require_once "./app/views/content/".$vista."-view.php";

?>