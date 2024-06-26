<?php

namespace app\models;

class viewsModel {
    // Método para obtener la vista seleccionada
    protected function obtenerVistasModelo(string $vista):string {
        // Lista de vistas posibles
        $witheList = ['index', 'login', 'usuarios', 'trabajadores', 'gestionPrincipal', 'configuracion', 'vehiculos',
            'clientes', 'mercancia', 'mercanciaEntregada', 'localizarPaquete'];

        if (in_array($vista, $witheList)) {
            if (is_file("./app/views/content/".$vista."-view.php")) {
                $contenido = "./app/views/content/".$vista."-view.php";
            }
            else {
                $contenido = "./app/views/content/404-view.php";
            }
        }
        else {
            $contenido = "./app/views/content/404-view.php";
        }
        return $contenido;
    }
}

?>