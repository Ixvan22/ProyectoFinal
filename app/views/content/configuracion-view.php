<?php

if (!isset($_SESSION["empleado"])) header("Location: ".APP_URL.'login');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion</title>
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestion-navbar.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/configuracion-style.css"/>   
</head>
<body>
    <div class="container-fluid p-0">
    <?php require_once 'app/views/inc/navbar-gestion.php'?>
        <header class="-header">
            <div class="-header-location">
                <a href="<?php echo APP_URL ?>gestionPrincipal">Gestión Interna</a> &gt; <span id="location">Configuración</span>
            </div>
        </header>
        <main class="-main-configuracion">
            <form action="." method="post">
                <div class="-header-configuracion">
                    <h2>Configuración</h2>
                    <div class="-header-buttons">
                        <button type="submit" class="btn btn-success" id="editUsuario">Guardar</a>
                    </div>
                </div>

                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-dni">DNI:</label>
                    <input type="text" class="w-75 form-control" id="edit-trabajador-dni" name="edit-trabajador-dni" autocomplete="none"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-nombre">Nombre:</label>
                    <input type="text" class="w-75 form-control" id="edit-trabajador-nombre" name="edit-trabajador-nombre" autocomplete="none"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-apellidos">Apellidos:</label>
                    <input type="text" class="w-75 form-control" id="edit-trabajador-apellidos" name="edit-trabajador-apellidos" autocomplete="none"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-telefono">Teléfono:</label>
                    <input type="number" class="w-75 form-control" id="edit-trabajador-telefono" name="edit-trabajador-telefono" autocomplete="none"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-correo">Correo:</label>
                    <input type="email" class="w-75 form-control" id="edit-trabajador-correo" name="edit-trabajador-correo" autocomplete="none"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-cargo">Cargo:</label>
                    <?php echo $insTipos->listarCargosControlador() ?>
                    <input type="text" class="w-75 form-control" id="edit-trabajador-cargo" name="edit-trabajador-cargo" autocomplete="none"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-fecha-nacimiento">Fecha nacimiento:</label>
                    <input type="date" class="w-75 form-control" id="edit-trabajador-fecha-nacimiento" name="edit-trabajador-fecha-nacimiento" autocomplete="none"/>
                </div>
                <div class="row d-flex align-items-center my-2 flex-column flex-md-row">
                    <label class="w-25" for="edit-trabajador-fecha-inicio">Fecha inicio empresa:</label>
                    <input type="date" class="w-75 form-control" id="edit-trabajador-fecha-inicio" name="edit-trabajador-fecha-inicio" autocomplete="none"/>
                </div>
            </form>
        </main>
    </div>
    <?php

    require_once 'app/views/inc/scripts.php';

    
    if (isset($_POST["editUsuario"])) {
        if (isset($url[1])) {
            echo $insConfig->editarUsuarioControlador($url[1]);
        }
        else {
            echo $insConfig->editarUsuarioControlador($_SESSION["empleado"]);
        }
    }
    ?>
</body>
</html>