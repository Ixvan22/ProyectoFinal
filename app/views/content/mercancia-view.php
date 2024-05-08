<?php

if (!isset($_SESSION["empleado"])) header("Location: ".APP_URL.'login');

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercancía</title>
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestion-navbar.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/mercancia-style.css"/>
</head>
<body>
    <div class="container-fluid p-0">
        <?php require_once 'app/views/inc/navbar-gestion.php'?>
        <header class="-header">
            <div class="-header-location">
                <a href="<?php echo APP_URL ?>gestionPrincipal">Gestión Interna</a> &gt; <span id="location">Mercancía</span>
            </div>
        </header>
        <main class="-main-mercancia">
            <div class="-header-mercancia-entregada">
                <h2>Mi mercancía</h2>
                <div class="-header-buttons">
                    <a href="<?php echo APP_URL ?>mercanciaEntregada" class="btn btn-secondary">Mercancía entregada</a>
                    <div class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-addMercancia">Añadir mercancia</div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal-addMercancia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Nueva mercancia</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?php echo APP_URL ?>mercancia" method="post">
                            <div class="modal-body">
                                <h6 class="text-center">Mercancia</h6>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nueva-mercancia-peso">Peso:</label>
                                    <input type="number" step="0.01" min="0.01" class="w-50 form-control" id="nueva-mercancia-peso" name="nueva-mercancia-peso" autocomplete="none"/>
                                    <?php echo $insTipos->listarPesosControlador() ?>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="mercancia-tipo-estado">Estado:</label>
                                    <?php echo $insTipos->listarMercanciaControlador() ?>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nueva-mercancia-descripcion">Descripción:</label>
                                    <textarea type="text" class="w-75 form-control" id="nueva-mercancia-descripcion" name="nueva-mercancia-descripcion" autocomplete="none"></textarea>
                                </div>
                                <hr>
                                <h6 class="text-center">Cliente existente</h6>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="mercancia-cliente-existente">DNI:</label>
                                    <?php echo $insCliente->listarClientesMercanciaControlador() ?>
                                </div>
                                <hr>
                                <h6 class="text-center">Añadir cliente</h6>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nuevo-cliente-dni">DNI:</label>
                                    <input type="text" class="w-75 form-control" id="nuevo-cliente-dni" name="nuevo-cliente-dni" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center">
                                    <label class="w-25" for="nuevo-cliente-nombre">Nombre:</label>
                                    <input type="text" class="w-75 form-control" id="nuevo-cliente-nombre" name="nuevo-cliente-nombre" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nuevo-cliente-apellidos">Apellidos:</label>
                                    <input type="text" class="w-75 form-control" id="nuevo-cliente-apellidos" name="nuevo-cliente-apellidos" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nuevo-cliente-telefono">Teléfono:</label>
                                    <input type="number" class="w-75 form-control" id="nuevo-cliente-telefono" name="nuevo-cliente-telefono" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nuevo-cliente-correo">Correo:</label>
                                    <input type="email" class="w-75 form-control" id="nuevo-cliente-correo" name="nuevo-cliente-correo" autocomplete="none"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="anadirMercancia">Añadir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row gy-3">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="-card-mercancia" data-bs-toggle="modal" data-bs-target="#modal-123456789123456789">
                        <div class="-card-mercancia-header">
                            <p><span id="-card-mercancia-status-icon"><i class="fa-solid fa-circle" style="color: green;"></i></span> Listo</p>
                            <p>
                                <span id="-card-mercancia-status-weight">300</span>
                                <span id="-card-mercancia-status-weight-type">KG</span>
                            </p>
                        </div>
                        <div class="-card-mercancia-main">
                            <p>123456789123456</p>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modal-123456789123456789" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Localizador: <span id="mercancia-modal-localizador">123456789123456789</span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="." method="post">
                                    <div class="modal-body">
                                        <div class="-modal-mercancia">
                                            <div class="row d-flex align-items-center">
                                                <label class="w-25" for="mercancia-vehiculo-asignado">Vehículo</label>
                                                <select class="form-select w-75" id="mercancia-vehiculo-asignado" name="mercancia-vehiculo-asignado">
                                                    <option value="default"></option>
                                                    <option value="1234ABC">1234ABC</option>
                                                </select>
                                            </div>
                                            <div class="row d-flex align-items-center my-2">
                                                <label class="w-25" for="mercancia-cliente-asignado">Cliente</label>
                                                <select class="form-select w-75" id="mercancia-cliente-asignado" name="mercancia-cliente-asignado">
                                                    <option value="default"></option>
                                                    <option value="1234ABC">123456789A</option>
                                                </select>
                                            </div>
                                            <div class="row d-flex align-items-center my-2">
                                                <label class="w-25" for="mercancia-estado-asignado">Estado</label>
                                                <select class="form-select w-75" id="mercancia-estado-asignado" name="mercancia-estado-asignado">
                                                    <option value="0">En proceso</option>
                                                    <option value="1">En almacen</option>
                                                    <option value="2">En centro logístico</option>
                                                    <option value="3">En reparto</option>
                                                    <option value="4">Entregado</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" name="guardar-estado-mercancia">Guardar cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <?php

    require_once 'app/views/inc/scripts.php';

    if (isset($_POST["anadirMercancia"])) {
        echo $insMercancia->anadirMercanciaControlador();
    }

    ?>
</body>
</html>