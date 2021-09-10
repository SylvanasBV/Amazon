<?php  declare(strict_types=1);
require_once ('../negocio/Tarjeta.php');
use PHPUnit\Framework\TestCase;


class TarjetaTest extends TestCase
{
    /**
     * Testeo de los atributos que deben componer una tarjeta
     */
    public static function testObtenerAtributosTarjeta(){
        TarjetaTest::assertObjectHasAttribute('numeroTarjeta', new Tarjeta);
        TarjetaTest::assertObjectHasAttribute('codigoVerificacion', new Tarjeta);
        TarjetaTest::assertObjectHasAttribute('fechaVencimiento', new Tarjeta);

    }

/**
 * Testeo de modificación y posterior acceso a los atributos de la clase
 */
    public function testModificarYaccesoAtributos(){
        $tarjeta=new Tarjeta();
        $tarjeta->setNumeroTarjeta(4475125678904216);
        $tarjeta->setCodigoVerificacion(528);
        $tarjeta->setFechaVencimiento('05-2025');
        TarjetaTest::assertEquals(4475125678904216,$tarjeta->getNumeroTarjeta());
        TarjetaTest::assertEquals(528,$tarjeta->getCodigoVerificacion());
        TarjetaTest::assertEquals('05-2025',$tarjeta->getFechaVencimiento());

    }

}






?>