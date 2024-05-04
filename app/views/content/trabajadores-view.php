<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajadores</title>

    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestion-navbar.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/trabajadores-style.css"/>
</head>
<body>
    <div class="container-fluid p-0">
        <header class="-header">
            <div class="-header-location">
                <a href="">Gestión Interna</a> &gt; <span id="location">Trabajadores</span>
            </div>
        </header>
        <main class="-main-usuarios">
            <div class="-header-usuarios">
                <h2>Trabajadores</h2>
                <div class="-header-buttons">
                    <a href="" class="btn btn-secondary">Cuentas de usuario</a>
                    <div class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-addUsers">Añadir trabajador</div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal-addUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Nuevo trabajador</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?php echo APP_URL; ?>trabajadores" method="post">
                            <div class="modal-body">
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nuevo-trabajador-dni">DNI:</label>
                                    <input type="text" class="w-75 form-control" id="nuevo-trabajador-dni" name="nuevo-trabajador-dni" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center">
                                    <label class="w-25" for="nuevo-trabajador-nombre">Nombre:</label>
                                    <input type="text" class="w-75 form-control" id="nuevo-trabajador-nombre" name="nuevo-trabajador-nombre" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nuevo-trabajador-apellidos">Apellidos:</label>
                                    <input type="text" class="w-75 form-control" id="nuevo-trabajador-apellidos" name="nuevo-trabajador-apellidos" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nuevo-trabajador-telefono">Teléfono:</label>
                                    <input type="number" class="w-75 form-control" id="nuevo-trabajador-telefono" name="nuevo-trabajador-telefono" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nuevo-trabajador-correo">Correo:</label>
                                    <input type="email" class="w-75 form-control" id="nuevo-trabajador-correo" name="nuevo-trabajador-correo" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nuevo-trabajador-cargo">Cargo:</label>
                                    <input type="text" class="w-75 form-control" id="nuevo-trabajador-cargo" name="nuevo-trabajador-cargo" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-50" for="nuevo-trabajador-fecha-nacimiento">Fecha nacimiento:</label>
                                    <input type="date" class="w-50 form-control" id="nuevo-trabajador-fecha-nacimiento" name="nuevo-trabajador-fecha-nacimiento" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-50" for="nuevo-trabajador-fecha-inicio">Fecha inicio empresa:</label>
                                    <input type="date" class="w-50 form-control" id="nuevo-trabajador-fecha-inicio" name="nuevo-trabajador-fecha-inicio" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="d-block w-25" for="nuevo-trabajador-cuenta">Crear cuenta:</label>
                                    <input type="checkbox" class="form-check-input p-2" style="width: max-content;" id="nuevo-trabajador-cuenta" name="nuevo-trabajador-cuenta"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="anadir-trabajador">Añadir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">DNI</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Fecha nacimiento</th>
                            <th scope="col">Fecha inicio</th>
                            <th scope="col">Cargo</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $insUsusario->listarUsuariosControlador() ?>
                </table>
            </div>
        </main>
    </div>
    <?php require_once 'app/views/inc/scripts.php'?>

    <?php
    if (isset($_POST["anadir-trabajador"])) {
        echo $insUsusario->anadirUsuarioControlador();
    }
    if (isset($url[1]) && $url[1] == 'anadirCuenta') {
        echo $insUsusario->anadirCuentaControlador($url[2]);
    }
    if (isset($url[1]) && $url[1] == 'eliminarCuenta') {
        echo $insUsusario->eliminarCuentaControlador($url[2]);
    }

    ?>
</body>
</html>

