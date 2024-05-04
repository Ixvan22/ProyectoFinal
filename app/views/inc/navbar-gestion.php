<?php

$insUsuario = new \app\controllers\userController();

?>

<div id="navbar" class="-navbar -navbar-responsive-closed">
    <div class="-navbar-links">
        <?php echo $insUsuario->listarUsuarioNavbarControlador($_SESSION["empleado"]); ?>
        <ul class="p-0 my-4">
            <a href=""><li>Inicio</li></a>
            <a href=""><li>Link 2</li></a>
        </ul>
        <ul class="p-0 m-0 -navbar-settings">
            <a href=""><li>Configuración</li></a>
            <a href="<?php echo APP_URL ?>login"><li>Salir</li></a>
        </ul>
    </div>
</div>
<div class="-navbar-icon">
    <i id="navbar-icon-open" class="fa-solid fa-bars"></i>
    <i id="navbar-icon-close" class="fa-solid fa-x -navbar-hidden"></i>
</div>
