<?php

class BaseDatos {
    private string $host;
    private string $user;
    private string $password;
    private string $database;

    public function __construct(string $host, string $user, string $password, string $database) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

    public function comprobarLogin(string $user, string $password):bool {
        $loginCorrecto = false;

        $db = new \PDO("myswl:host=".$this->host.";dbname=".$this->database, $this->user, $this->password);
        $stmt = $db->prepare('select * from usuarios where user = :usuario and password = :password');
        $stmt->bindParam(":usuario", $user);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) $loginCorrecto = true;

        return $loginCorrecto;
    }


}

?>