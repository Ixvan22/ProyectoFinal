<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesseract Solutions - Iniciar sesión</title>
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/login-style.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/index-navbar.css"/>
</head>
<body>

<div class="container-fluid p-0">
    <?php require_once 'app/views/inc/navbar-index.php'?>
    <section class="gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-6">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="<?php echo APP_URL ?>app/views/img/logo-letras-png.png"
                                             style="width: 185px;" alt="logo">

                                    </div>

                                    <form method="post" action="<?php echo APP_URL.'login' ?>">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="login-dni">DNI</label>
                                            <input type="text" id="login-dni" class="form-control" name="login-dni"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="login-password">Contraseña</label>
                                            <input type="password" id="login-password" class="form-control" name="login-password" />
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-dark fa-lg p-3 mb-3" name="login" type="submit"> Iniciar sesión</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once 'app/views/inc/scripts.php'?>
</body>
</html>

<?php
    if (isset($_SESSION["empleado"])) unset($_SESSION["empleado"]);
    if (isset($_SESSION["cargo_empleado"])) unset($_SESSION["cargo_empleado"]);
    if (isset($_POST['login'])) {
        echo $insLogin->loginUsuarioControlador();
    }

?>