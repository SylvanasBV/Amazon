<?php
require_once ('../negocio/ManejoParametro.php');
require_once ('../persistencia/util/Conexion.php');
use PHPUnit\Framework\TestCase;


class ManejoParametroTest extends TestCase{

    /**
     * Prueba registrar un nuevo parámetro en la base de datos
     */
public function testCrearParametro(){
    $conexion=new Conexion();
        $conexionUsar=$conexion->conectarBD($conexion);
        $parametro=new Parametro();
        $parametro->setCodigo (3707);
        $parametro->setTarifa(90);
        $parametro->setCapacidad(120);
        $parqueadero=new Parqueadero();
        $parqueadero->setCodParqueadero(1);
        ManejoParametro::setConexionBD($conexionUsar);
        ManejoParametroTest::assertEquals(ManejoParametro::crearParametro($parametro,$parqueadero),ManejoParametro::consultarParametroPorParqueadero($parqueadero));
}

/**
 * Prueba, listar todos los parámetros que están registrados en la base de datos
 */
public function testListarParametros(){
    $conexion=new Conexion();
        $conexionUsar=$conexion->conectarBD($conexion);
        ManejoParametro::setConexionBD($conexionUsar);
        ManejoParametroTest::assertNotEmpty(ManejoParametro::listarParametros());
}

/**
 * Prueba modificar un parámetro
 */
public function testModificarParametro(){
    $conexion=new Conexion();
    $conexionUsar=$conexion->conectarBD($conexion);
    $parametro=new Parametro();
    $parametro=new Parametro();
        $parametro->setCodigo (3707);
        $parametro->setTarifa(78);
        $parametro->setCapacidad(20);
    ManejoTarjeta::setConexionBD($conexionUsar);
    ManejoTarjetaTest::assertTrue(ManejoTarjeta::modificarParametro($parametro));


}
/**
 * Prueba de consulta de parametro de un parqueadero
 */
public function testconsultarParametroPorParqueadero(){
    $conexion=new Conexion();
        $conexionUsar=$conexion->conectarBD($conexion);
        ManejoParametro::setConexionBD($conexionUsar);
    $parqueadero=new Parqueadero();
        $parqueadero->setCodParqueadero(1);
        $parametro=new Parametro();
        $parametro->setCodigo (3707);
        $parametro->setTarifa(90);
        $parametro->setCapacidad(120);
        ManejoParametroTest::assertEquals(ManejoParametro::consultarParametroPorParqueadero($parqueadero),$parametro);

}

}


?>