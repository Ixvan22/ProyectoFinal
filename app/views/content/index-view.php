<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesseract Solutions - Inicio</title>
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
                <img src="<?php echo APP_URL ?>app/views/img/carousel1.jpg" class="d-block w-100" alt="Tesseract Solutions">
            </div>
            <div class="carousel-item">
                <img src="<?php echo APP_URL ?>app/views/img/carousel2.jpg" class="d-block w-100" alt="Tesseract Solutions">
            </div>
            <div class="carousel-item">
                <img src="<?php echo APP_URL ?>app/views/img/carousel3.jpg" class="d-block w-100" alt="Tesseract Solutions">
            </div>
        </div>
    </div>

    <div class="-box-package">
        <h5>Localiza tu paquete</h5>
        <form action="<?php echo APP_URL ?>localizarPaquete" method="post" class="-box-package-form">
            <input type="text" name="localizador" placeholder="Número de seguimiento"/>
            <button type="submit" class="btn btn-dark">Buscar</button>
        </form>
    </div>

    <div class="d-flex justify-content-around mt-5 gap-1 -index-logos">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <h3 class="text-center">Envía tu mercancía</h3>
            <img src="<?php echo APP_URL ?>app/views/img/index-logo-paquete.png" alt="Paquete" id="logo-paquete">
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <h3 class="text-center">La transportamos por tí</h3>
            <img src="<?php echo APP_URL ?>app/views/img/index-logo-camion.png" alt="Camión">
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <h3 class="text-center">Recibela en casa</h3>
            <img src="<?php echo APP_URL ?>app/views/img/index-logo-casa.png" alt="Casa">
        </div>
    </div>
    
    <footer class="bg-dark text-light d-flex justify-content-center align-items-center gap-5 p-4 mt-4">
        <p class="-license text-center" xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/">
            <span property="dct:title">Tesseract Solutions</span> by
            <span property="cc:attributionName">Iván García</span> is licensed under
            <a href="http://creativecommons.org/licenses/by-nc/4.0/?ref=chooser-v1"
               target="_blank" rel="license noopener noreferrer" style="display:inline-block;">
                CC BY-NC 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;"
                                 src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1">
                <img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;"
                     src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1">
                <img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;"
                     src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1"></a></p>
    </footer>
    
</div>
<?php require_once 'app/views/inc/scripts.php'?>
</body>
</html>