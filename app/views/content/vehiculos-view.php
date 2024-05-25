<?php

if (!isset($_SESSION["empleado"])) header("Location: ".APP_URL.'login');
if ($_SESSION["cargo_empleado"] != 1 && $_SESSION["cargo_empleado"] != 2) header("Location: ".APP_URL.'gestionPrincipal');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesseract Solutions - Vehículos</title>
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestion-navbar.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/vehiculos-style.css"/>
</head>
<body>

    <div class="container-fluid p-0">
    <?php require_once 'app/views/inc/navbar-gestion.php'?>
        <header class="-header">
            <div class="-header-location">
                <a href="<?php echo APP_URL ?>gestionPrincipal">Gestión Interna</a> &gt; <span id="location">Vehículos</span>
            </div>
        </header>
        <main class="-main-vehicles">
            <div class="-header-vehicles">
                <h2>Mis vehículos</h2>
                <div class="-header-buttons">
                    <a href="" class="btn btn-secondary">Filtros?</a>
                    <?php if ($_SESSION["cargo_empleado"] == 1) { ?>
                    <div class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-addVehiculo">Añadir vehículo</div>
                    <?php } ?>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal-addVehiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Nuevo vehículo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?php echo APP_URL ?>vehiculos" method="post">
                            <div class="modal-body">
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nuevo-vehiculo-matricula">Matrícula:</label>
                                    <input type="text" class="w-75 form-control" id="nuevo-vehiculo-matricula" name="nuevo-vehiculo-matricula" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="vehiculo-tipo-estado">Estado:</label>
                                    <?php echo $insTipos->listarVehiculosControlador()?>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nuevo-vehiculo-carga">Carga útil:</label>
                                    <input type="number" step="0.01" min="0.01" class="w-50 form-control" id="nuevo-vehiculo-carga" name="nuevo-vehiculo-carga" autocomplete="none"/>
                                    <?php echo $insTipos->listarPesosControlador() ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="anadirVehiculo">Añadir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row gy-3">
                <?php echo $insVehiculo->listarVehiculosControlador() ?>
            </div>
        </main>

    </div>
    <?php

    require_once 'app/views/inc/scripts.php';

    if (isset($_POST["anadirVehiculo"])) {
        echo $insVehiculo->anadirVehiculoControlador();
    }
    if (isset($_POST["guardar-estado-vehículo"])) {
        echo $insVehiculo->actualizarVehiculoControlador();
    }
    if (isset($url[1]) && $url[1] == 'eliminarMercanciaVehiculo') {
        echo $insVehiculo->eliminarMercanciaVehiculo($url[2], $url[3]);
    }
    if (isset($url[1]) && $url[1] == 'eliminarVehiculo') {
        echo $insVehiculo->eliminarVehiculoControlador($url[2]);
    }

    ?>

</body>
</html>