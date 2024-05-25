<?php

if (!isset($_SESSION["empleado"])) header("Location: ".APP_URL.'login');
if ($_SESSION["cargo_empleado"] != 1 && $_SESSION["cargo_empleado"] != 4) header("Location: ".APP_URL.'gestionPrincipal');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesseract Solutions - Cuentas de usuario</title>
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestion-navbar.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/usuarios-style.css"/>
</head>
<body>
    <div class="container-fluid p-0">
        <?php require_once 'app/views/inc/navbar-gestion.php'?>
        <header class="-header">
            <div class="-header-location">
                <a href="<?php echo APP_URL ?>gestionPrincipal">Gestión Interna</a> &gt;
                <a href="<?php echo APP_URL ?>trabajadores">Trabajadores</a> &gt; <span id="location">Cuentas de usuarios</span>
            </div>
        </header>
        <main class="-main-cuenta-usuarios">
            <div class="-header-cuenta-usuarios">
                <h2>Cuentas de usuario</h2>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">DNI</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Fecha nacimiento</th>
                            <th scope="col">Fecha inicio</th>
                            <th scope="col">Cargo</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $insUsuario->listarCuentasControlador() ?>
                </table>
            </div>
        </main>
    </div>
    <?php
    require_once 'app/views/inc/scripts.php';

    if (isset($url[1]) && $url[1] == 'eliminarCuenta') {
        echo $insUsusario->eliminarCuentaControlador($url[2], false);
    }

    ?>

</body>
</html>