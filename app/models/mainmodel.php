<?php

namespace app\models;
use \PDO;
use app\controllers\alertController;

if (file_exists(__DIR__."/../config/server.php")) {
    require_once __DIR__."/../config/server.php";
}

class mainModel {
    private string $server = DB_SERVER;
    private string $db = DB_NAME;
    private string $user = DB_USER;
    private string $pass = DB_PASS;
    public alertController $alertController;

    public function __construct() {
        $this->alertController = new alertController();
    }

    // Método para conectarse a la base de datos
    protected function conectar():PDO {
        $conexion = new PDO("mysql:host=".$this->server.";dbname=".$this->db, $this->user, $this->pass);
        $conexion->exec("SET CHARACTER SET utf8");
        return $conexion;
    }

    // Método para ejecutar consulta
    public function ejecutarConsulta(string $consulta) {
        $sql = $this->conectar()->prepare($consulta);
        $sql->execute();
        return $sql;
    }

    // Método para ejecutar consulta y pasarlo a un array con solo el primer campo
    public function consultaToArrayUnico(string $consulta):array {
        $array = [];
        $sql = $this->conectar()->prepare($consulta);
        $sql->execute();
        while ($result = $sql->fetch(PDO::FETCH_NUM)) {
            $result = $result[0];
            $array[] = $result;
        }
        return $array;
    }

    // Método para limpiar cadenas y prevenir SQLInjection
    public function limpiarCadena(string $cadena):string {
        $palabras = ["<script>","</script>","<script src","<script type=",
        "SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE",
        "DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>",
        "--","^","<",">","==","=",";","::"];
        
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);

        foreach($palabras as $palabra) {
            $cadena = str_ireplace($palabra, "", $cadena);
        }

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        
        return $cadena;
    }

    // Método para comprobar patrones
    protected function verificarDatos(string $filtro, string $cadena):bool {
        if (preg_match("/^".$filtro."$/", $cadena)) {
            return true;
        }
        else {
            return false;
        }
    }

    // Método para insertar datos en la base de datos
    public function guardarDatos(string $tabla, array $datos) {
        $consulta = "INSERT INTO $tabla (";

        $C = 0;
        foreach ($datos as $dato) {
            if ($C >= 1) { $consulta .= ","; }
            $consulta .= $dato["campo_nombre"];
            $C++;
        }

        $consulta .= ") VALUES (";

        $C = 0;
        foreach ($datos as $dato) {
        if ($C >= 1) { $consulta .= ","; }
            $consulta .= $dato["campo_marcador"];
            $C++;
        }

        $consulta .= ")";
        $sql = $this->conectar()->prepare($consulta);
        
        foreach ($datos as $dato) {
            $sql->bindParam($dato["campo_marcador"], $dato["campo_valor"]);
        }

        $sql->execute();
        
        return $sql;
    }

    // Método para actualizar datos en la base de datos
    public function actualizarDatos(string $tabla, array $datos, string $condicion) {
        $consulta = "UPDATE $tabla SET ";
    
        $C = 0;
        foreach ($datos as $dato) {
            if ($C >= 1) { $consulta .= ","; }
            $consulta .= $dato["campo_nombre"] . " = " . $dato["campo_marcador"];
            $C++;
        }
    
        $consulta .= " WHERE " . $condicion;
    
        $sql = $this->conectar()->prepare($consulta);
    
        foreach ($datos as $dato) {
            $sql->bindParam($dato["campo_marcador"], $dato["campo_valor"]);
        }
    
        $sql->execute();
    
        return $sql;
    }
}

?>