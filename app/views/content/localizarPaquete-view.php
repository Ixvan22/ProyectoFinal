<?php

if (!isset($_POST["localizador"]) || $_POST["localizador"] == "") header("Location: ".APP_URL);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesseract Solutions - Localizar Paquete</title>
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/localizarPaquete-style.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/index-navbar.css"/>
</head>
<body>
    <div class="container-fluid p-0">
        <?php require_once 'app/views/inc/navbar-index.php'?>
        <main class="-localizar-paquete">
            <div class="-localizar-paquete-card">
                <?php echo $insMercancia->listarMercanciaClienteControlador($_POST["localizador"]); ?>
            </div>
        </main>
    </div>
    <?php require_once 'app/views/inc/scripts.php'?>
</body>
</html>