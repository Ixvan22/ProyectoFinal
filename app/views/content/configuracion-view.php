<?php

if (!isset($_SESSION["empleado"])) header("Location: ".APP_URL.'login');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesseract Solutions - Configuración</title>
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
            <form action="<?php echo APP_URL ?>configuracion" method="post">
                <div class="-header-configuracion">
                    <h2>Configuración</h2>
                    <div class="-header-buttons">
                        <button type="submit" class="btn btn-success" id="editUsuario" name="editUsuario">Guardar</button>
                    </div>
                </div>

                <?php

                    if (isset($url[1]) && $url[1] != '') {
                        echo $insConfig->listarFormConfigControlador($url[1]);
                    }
                    else {
                        echo $insConfig->listarFormConfigControlador($_SESSION["empleado"]);
                    }
                ?>

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