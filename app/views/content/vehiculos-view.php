<?php

if (!isset($_SESSION["empleado"])) header("Location: ".APP_URL.'login');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos</title>
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
                    <div class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-addVehiculo">Añadir vehículo</div>
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
                <div class="col-lg-3 col-md-4 col-sm-6 col-12" data-bs-toggle="modal" data-bs-target="#modal-1234ABC">
                    <div class="-card-vehicle">
                        <div class="-card-vehicle-header">
                            <p><span id="-card-vehicle-status-icon"><i class="fa-solid fa-circle" style="color: green;"></i></span> Listo</p>
                            <p>
                                <span id="-card-vehicle-status-weight">300</span>
                                 / 
                                <span id="-card-vehicle-status-weight-max">500</span>
                                 
                                <span id="-card-vehicle-status-weight-type">KG</span>
                            </p>
                        </div>
                        <div class="-card-vehicle-main">
                            <p>1234ABC</p>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-1234ABC" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Vehículo: <span id="vehiculo-modal-matricula">1234ABC</span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="." method="post">
                                <div class="modal-body">
                                    <div class="-modal-mercancia">
                                        <div class="row d-flex align-items-center">
                                            <label class="w-50" for="vehiculo-asignar-mercancia">Añadir mercancia:</label>
                                            <select class="form-select w-50" id="vehiculo-asignar-mercancia" name="vehiculo-mercancia-asignada">
                                                <option value="default"></option>
                                                <option value="123456789123456">123456789123456</option>
                                            </select>
                                        </div>
                                        <div class="row d-flex align-items-center my-2">
                                            <label class="w-25" for="vehiculo-tipo-estado">Estado:</label>
                                            <?php echo $insTipos->listarVehiculosControlador()?>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?php echo APP_URL ?>vehiculos/eliminarVehiculo/matricula" class="btn btn-danger">Eliminar</a>
                                    <div class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-mercanciaAsignada">Mercancia asignada</div>
                                    <button type="submit" class="btn btn-success" name="guardar-estado-vehículo">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-mercanciaAsignada" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Vehículo: <span id="vehiculo-modal-matricula">1234ABC</span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body">
                                    <div class="-modal-mercancia">
                                        <div class="row d-flex align-items-center">
                                            <h6 class="w-50">123456789123</h6>
                                            <h6 class="w-25 text-end">80 KG</h6>
                                            <a href="<?php echo APP_URL ?>vehiculos/eliminarMercancia/matricula/mercancia" class="w-25 text-end">
                                            <i class="fa-solid fa-x btn btn-danger"></i></a>
                                        </div>

                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

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
        // TODO IMPLEMENTAR METODO
        echo "a";
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