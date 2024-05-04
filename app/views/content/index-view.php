<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINCIPAL</title>
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/index-style.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/index-navbar.css"/>
</head>
<body>

<div class="container-fluid p-0">
    <?php require_once 'app/views/inc/navbar-index.php'?>
    <!-- Carousel -->
    <div id="carouselAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2000" data-bs-pause="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://picsum.photos/id/684/600/400" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://picsum.photos/id/237/600/400" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://picsum.photos/id/684/600/400" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <div class="-box-package">
        <h5>Localiza tu paquete</h5>
        <form action="." method="get" class="-box-package-form">
            <input type="text" name="localizador" placeholder="Número de seguimiento"/>
            <button type="submit" class="btn btn-dark">Buscar</button>
        </form>
    </div>
</div>
<?php require_once 'app/views/inc/scripts.php'?>
</body>
</html>