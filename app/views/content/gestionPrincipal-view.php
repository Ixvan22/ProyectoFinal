<?php

if (!isset($_SESSION["empleado"])) header("Location: ".APP_URL.'login');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesseract Solutions - Gestión Interna</title>
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestion-navbar.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestionPrincipal-style.css"/>
</head>
<body>

    <div class="container-fluid p-0">
        <?php require_once 'app/views/inc/navbar-gestion.php'?>
        <header class="-header">
            <div class="-header-location">
                <a href="<?php echo APP_URL ?>gestionPrincipal">Gestión Interna</a> &gt; <span id="location">Inicio</span>
            </div>
            <div class="-header-workday">
                <div class="-header-workday-hours">
                    <p class="m-0">Entrada: <span id="workday-start">--:--:--</span></p>
                    <p class="m-0">Salida: <span id="workday-end">--:--:--</span></p>
                </div>
                <button type="submit" id="btn-workday"  value="start" class="btn btn-success px-3">Iniciar</button>
            </div>
        </header>
        <main class="-main-principal">
            <div class="-header-estructura m-0">
                <h2>Planificación diaria</h2>
                <div class="-header-buttons">
                    <div class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-addPlanificacion">Añadir planificación</div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal-addPlanificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Nueva planificación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?php echo APP_URL ?>gestionPrincipal" method="post">
                            <div class="modal-body">
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nueva-planificacion-fecha">Fecha:</label>
                                    <input type="date" class="w-75 form-control" id="nueva-planificacion-fecha" name="nueva-planificacion-fecha" autocomplete="none"/>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="dni-cliente">DNI:</label>
                                    <?php echo $insTipos->listarDniClientesControlador() ?>
                                </div>
                                <div class="row d-flex align-items-center my-2">
                                    <label class="w-25" for="nueva-planificacion-descripcion">Descripción:</label>
                                    <textarea type="text" class="w-75 form-control" id="nueva-planificacion-descripcion" name="nueva-planificacion-descripcion" autocomplete="none"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="anadirPlanificacion">Añadir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive mb-5">
                <table class="table">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col" class="col-10">Descripción</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php echo $insUsuario->listarPlanificacionUsuarioControlador(); ?>
                    </tbody>
                </table>
            </div>

            <div class="-header-estructura m-0">
                <h2>Jornadas recientes</h2>
                <div class="-header-buttons">
                    <a href="" class="btn btn-secondary">Filtros?</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora entrada</th>
                        <th scope="col">Hora salida</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php echo $insUsuario->listarJornadaUsuarioControlador(); ?>
                    </tbody>
                </table>
            </div>
        </main>

    </div>

    <?php require_once 'app/views/inc/scripts.php'?>
    <script src="<?php echo APP_URL ?>app/views/js/workday.js"></script>

    <?php 
        if (isset($_POST["anadirPlanificacion"])) {
            echo $insUsuario->anadirPlanificacionUsuarioControlador();
        }
    ?>
</body>
</html>