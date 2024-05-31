<?php

if (!isset($_SESSION["empleado"])) header("Location: ".APP_URL.'login');
if ($_SESSION["cargo_empleado"] != 1 && $_SESSION["cargo_empleado"] != 3) header("Location: ".APP_URL.'gestionPrincipal');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesseract Solutions - Mercancíaentregada</title>
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestion-navbar.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/mercanciaEntregada-style.css"/>
</head>
<body>

    <div class="container-fluid p-0">
        <?php require_once 'app/views/inc/navbar-gestion.php'?>
        <header class="-header">
            <div class="-header-location">
                <a href="<?php echo APP_URL ?>gestionPrincipal">Gestión Interna </a> &gt; <a href="<?php echo APP_URL ?>mercancia">Mercancía</a> &gt; <span id="location">Mercancía entregada</span>
            </div>
        </header>
        <main class="-main-mercancia">
            <h2>Mercancía entregada</h2>
            <div class="row gy-3">
                <?php echo $insMercancia->listarMercanciaEntregadaControlador(); ?>
            </div>

        </main>

    </div>
    
    <?php
    require_once 'app/views/inc/scripts.php';

    if (isset($url[1]) && $url[1] == "eliminarMercancia") {
        echo $insMercancia->eliminarMercanciaControlador($url[2]);
    }

    ?>
</body>
</html>