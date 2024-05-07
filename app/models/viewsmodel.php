<?php

namespace app\models;

class viewsModel {
    protected function obtenerVistasModelo(string $vista):string {
        $witheList = ['index', 'login', 'usuarios', 'trabajadores', 'gestionPrincipal', 'configuracion', 'vehiculos'];

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