<?php

namespace app\models;

class viewsModel {
    protected function obtenerVistasModelo(string $vista):string {
        $witheList = ['index', '404', 'login', 'usuarios'];

        if (in_array($vista, $witheList)) {
            if (is_file("./app/views/content/".$vista."-view.php")) {
                $contenido = "./app/views/content/".$vista."-view.php";
            }
            else {
                $contenido = "404";
            }
        }
        return $contenido;
    }
}

?>