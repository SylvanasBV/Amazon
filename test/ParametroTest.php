<?php 
require_once ('../negocio/Parametro.php');
use PHPUnit\Framework\TestCase;

class ParametroTest extends TestCase{

/**
     * Testeo de los atributos que deben componer un parametro
     */
    public static function testObtenerAtributosParametro(){
        ParametroTest::assertObjectHasAttribute('codigo', new Parametro);
        ParametroTest::assertObjectHasAttribute('capacidad', new Parametro);
        ParametroTest::assertObjectHasAttribute('tarifa', new Parametro);
        ParametroTest::assertObjectHasAttribute('horaApertura', new Parametro);
        ParametroTest::assertObjectHasAttribute('horaCierre', new Parametro);

    }

    /**
 * Testeo de modificación y posterior acceso a los atributos de la clase parámetro
 */
    public function testModificarYaccesoAtributos(){
        $parametro=new Parametro();
        $parametro->setCodigo(723);
        $parametro->setCapacidad(200);
        $parametro->setTarifa(60);
        $parametro->setHoraApertura('05:00');
        $parametro->setHoraCierre('22:00');
        ParametroTest::assertEquals(723,$parametro->getCodigo());
        ParametroTest::assertEquals(200,$parametro->getCapacidad());
        ParametroTest::assertEquals(60,$parametro->getTarifa());
        ParametroTest::assertEquals('05:00',$parametro->getHoraApertura());
        ParametroTest::assertEquals('22:00',$parametro->getHoraCierre());

}
}


?>