<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <title>404 | Página no encontrada</title>
</head>
<body>
<header>
    <nav class="bg-info pt-3 pb-3">
        <div class="container">
            <h3 class="text-white">Tesseract Solutions</h3>
        </div>
    </nav>
    <div class="bg-light text-center pt-5" style="height: 100vh;">
        <div class="container">
            <h1 class="display-1 pt-5 font-weight-bold">404</h1>
            <h1 class="display-4 pt-1 pb-3">Página no encontrada</h1>
            <h3 class="font-weight-light text-secondary">La página que estabas buscando <br> no existe</h3>
            <a href="<?php echo APP_URL ?>" class="btn btn-info mt-3 pt-3 pb-3 pr-4 pl-4">Volver al inicio</a>
        </div>
    </div>
</header>
<?php
require_once 'app/views/inc/scripts.php';
?>
?>
</body>
</html>