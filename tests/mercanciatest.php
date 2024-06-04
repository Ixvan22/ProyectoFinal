<?php


require_once "../app/models/mainmodel.php";
require_once "../app/controllers/alertcontroller.php";
require_once "../app/controllers/clientecontroller.php";
require_once "../app/controllers/mercanciacontroller.php";


use app\controllers\mercanciaController;
use app\controllers\alertController;
use PHPUnit\Framework\TestCase;

$insMercancia = new mercanciaController();
$insAlerta = new alertController();

class MercanciaTest extends TestCase {
    public function testAnadirMercancia() {
        $this->assertEquals(4, 2+2);
    }
}

?>