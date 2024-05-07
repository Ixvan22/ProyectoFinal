<?php

if (!isset($_SESSION["empleado"])) header("Location: ".APP_URL.'login');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <?php require_once 'app/views/inc/icon-header.php'?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestion-navbar.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/clientes-style.css"/>    
</head>
<body>

    <div class="container-fluid p-0">
    <?php require_once 'app/views/inc/navbar-gestion.php'?>
        <header class="-header">
            <div class="-header-location">
                <a href="<?php echo APP_URL ?>gestionPrincipal">Gestión Interna </a> &gt; <span id="location">Clientes</span>
            </div>
        </header>
        <main class="-main-clientes">
            <div class="-header-clientes">
                <h2>Clientes</h2>
                <div class="-header-buttons">
                    <div class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-addClientes">Añadir cliente</div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal-addClientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Nuevo cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?php echo APP_URL ?>clientes" method="post">
                            <div class="modal-body">
                                <div class="-modal-mercancia">
                                    <div class="row d-flex align-items-center my-2">
                                        <label class="w-25" for="nuevo-cliente-dni">DNI:</label>
                                        <input type="text" class="w-75 form-control" id="nuevo-cliente-dni" name="nuevo-cliente-dni" autocomplete="none"/>
                                    </div>
                                    <div class="row d-flex align-items-center my-2">
                                        <label class="w-25" for="nuevo-cliente-nombre">Nombre:</label>
                                        <input type="text" class="w-75 form-control" id="nuevo-cliente-nombre" name="nuevo-cliente-nombre" autocomplete="none"/>
                                    </div>
                                    <div class="row d-flex align-items-center my-2">
                                        <label class="w-25" for="nuevo-cliente-apellidos">Apellidos:</label>
                                        <input type="text" class="w-75 form-control" id="nuevo-cliente-apellidos" name="nuevo-cliente-apellidos" autocomplete="none"/>
                                    </div>
                                    <div class="row d-flex align-items-center my-2">
                                        <label class="w-25" for="nuevo-cliente-telefono">Teléfono:</label>
                                        <input type="text" class="w-75 form-control" id="nuevo-cliente-telefono" name="nuevo-cliente-telefono" autocomplete="none"/>
                                    </div>
                                    <div class="row d-flex align-items-center my-2">
                                        <label class="w-25" for="nuevo-cliente-correo">Correo:</label>
                                        <input type="email" class="w-75 form-control" id="nuevo-cliente-correo" name="nuevo-cliente-correo" autocomplete="none"/>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="anadirCliente">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row gy-3">
                <?php echo $insCliente->listarClientesControlador(); ?>               
            </div>

        </main>

    </div>
    
<?php

    require_once 'app/views/inc/scripts.php';

    if (isset($_POST["anadirCliente"])) {
        echo $insCliente->anadirClienteControlador();
    }
    if (isset($url[1]) && $url[1] == 'eliminarCliente') {
        echo $insCliente->eliminarClienteControlador($url[2]);
    }

?>

</body>
</html>