<?php

$insUsuario = new \app\controllers\userController();

?>

<div id="navbar" class="-navbar -navbar-responsive-closed">
    <div class="-navbar-links">
        <?php echo $insUsuario->listarUsuarioNavbarControlador($_SESSION["empleado"]); ?>
        <ul class="p-0 my-4">
            <a href="<?php echo APP_URL ?>gestionPrincipal"><li>Inicio</li></a>
            <?php if ($_SESSION["cargo_empleado"] == 1 || $_SESSION["cargo_empleado"] == 2) { ?>
            <a href="<?php echo APP_URL ?>vehiculos"><li>Vehículos</li></a>
            <?php } ?>
            <?php if ($_SESSION["cargo_empleado"] == 1 || $_SESSION["cargo_empleado"] == 3) { ?>
            <a href="<?php echo APP_URL ?>mercancia"><li>Mercancía</li></a>
            <a href="<?php echo APP_URL ?>mercanciaEntregada"><li>Mercancía entregada</li></a>
            <?php } ?>
            <?php if ($_SESSION["cargo_empleado"] == 1 || $_SESSION["cargo_empleado"] == 4) { ?>
            <a href="<?php echo APP_URL ?>trabajadores"><li>Trabajadores</li></a>
            <a href="<?php echo APP_URL ?>usuarios"><li>Cuentas de usuario</li></a>
            <a href="<?php echo APP_URL ?>clientes"><li>Clientes</li></a>
            <?php } ?>
        </ul>
        <ul class="p-0 m-0 -navbar-settings">
            <a href="<?php echo APP_URL ?>configuracion" class="-navbar-config"><li>Configuración</li></a>
            <a href="<?php echo APP_URL ?>login" class="-navbar-exit"><li>Salir</li></a>
        </ul>
    </div>
</div>
<div class="-navbar-icon">
    <i id="navbar-icon-open" class="fa-solid fa-bars"></i>
    <i id="navbar-icon-close" class="fa-solid fa-x -navbar-hidden"></i>
</div>
