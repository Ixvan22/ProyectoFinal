<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINCIPAL</title>
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestion-navbar.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestionPrincipal-style.css"/>
</head>
<body>

    <div class="container-fluid p-0">
        <?php require_once 'app/views/inc/navbar-gestion.php'?>
        <header class="-header">
            <div class="-header-location">
                <a href="<?php echo APP_URL ?>gestionPrincipal">Gestión Interna</a> &gt; <span id="location">Inicio</span>
            </div>
            <div class="-header-workday">
                <div class="-header-workday-hours">
                    <p class="m-0">Entrada: <span id="workday-start">--:--:--</span></p>
                    <p class="m-0">Salida: <span id="workday-end">--:--:--</span></p>
                </div>
                <button type="submit" id="btn-workday"  value="start" class="btn btn-success px-3">Iniciar</button>
            </div>
        </header>

    </div>

    <?php require_once 'app/views/inc/scripts.php'?>
    <script src="<?php echo APP_URL ?>app/views/js/workday.js"></script>
</body>
</html>