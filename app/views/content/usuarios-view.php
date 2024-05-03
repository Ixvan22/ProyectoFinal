<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajadores</title>

    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/gestion-navbar.css"/>
    <link rel="stylesheet" href="<?php echo APP_URL ?>app/views/css/usuarios-style.css"/>
</head>
<body>
    <div class="container-fluid p-0">
        <?php require_once 'app/views/inc/navbar-gestion.php'?>
        <header class="-header">
            <div class="-header-location">
                <a href="">Gestión Interna</a> &gt; <a href="">Trabajadores</a> &gt; <span id="location">Cuentas de usuarios</span>
            </div>
        </header>
        <main class="-main-cuenta-usuarios">
            <div class="-header-cuenta-usuarios">
                <h2>Cuentas de usuario</h2>
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
                            <th scope="col">Cargo</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <th scope="row">123456789A</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                            <td>Transportista</td>
                            <td class="d-flex"><a href="" class="btn btn-danger">Eliminar</a><a href="" class="btn btn-success mx-2">Editar</a></td>
                        </tr>
                </table>
            </div>
        </main>
    </div>
    <?php require_once 'app/views/inc/scripts.php'?>
</body>
</html>