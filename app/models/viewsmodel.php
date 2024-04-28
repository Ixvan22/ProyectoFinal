<?php

namespace app\models;

class viewsModel {
    protected function obtenerVistasModelo(string $vista):string {
        $witheList = [];

        if (in_array($vista, $witheList)) {
            if (is_file("./app/views/content/".$vista."-view.php")) {
                $contenido = "./app/views/content/".$vista."-view.php";
            }
            else {
                $contenido = "404";
            }
        }
        elseif ($vista == "index") {
            $contenido = "index";
        }
        else {
            $contenido = "404";
        }

        return $contenido;
    }
}

?>