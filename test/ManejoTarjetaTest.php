<?php
require_once('../negocio/ManejoTarjeta.php');
require_once('../persistencia/util/Conexion.php');
use PHPUnit\Framework\TestCase;



class ManejoTarjetaTest extends TestCase{

       
/**
 * Testeo de la busqueda de una tarjeta especifica
 */
    public function testbuscarTarjeta(){
        $conexion=new Conexion();
        $conexionUsar=$conexion->conectarBD($conexion);
        $tarjeta=new tarjeta();
        $tarjeta->setNumeroTarjeta(376411234531007);
        $tarjeta->setCodigoVerificacion(1232);
        $tarjeta->setFechaVencimiento('2024-01-01 00:00:00');
        ManejoTarjeta::setConexionBD($conexionUsar);
        ManejoTarjetaTest::assertEquals($tarjeta,ManejoTarjeta::buscarTarjeta(376411234531007));

    }

    /**
     * Prueba al crear una tarjeta
     */
    public function testCrearTarjeta(){
        $conexion=new Conexion();
        $conexionUsar=$conexion->conectarBD($conexion);
        $tarjeta=new tarjeta();
        $tarjeta->setNumeroTarjeta(4711091651409485);
        $tarjeta->setCodigoVerificacion(243);
        $tarjeta->setFechaVencimiento('2025-09-01 00:00:00');
        ManejoTarjeta::setConexionBD($conexionUsar);
        ManejoTarjetaTest::assertEquals(ManejoTarjeta::crearTarjeta($tarjeta),ManejoTarjeta::buscarTarjeta(4711091651409485));


    }

    /**
     * Prueba de listar las tarjetas
     */
    public function testListarTarjetas(){
        $conexion=new Conexion();
        $conexionUsar=$conexion->conectarBD($conexion);
        ManejoTarjeta::setConexionBD($conexionUsar);
        ManejoTarjetaTest::assertNotEmpty(ManejoTarjeta::listarTarjetas());


    }

    /**
     * Prueba al modificar una tarjeta
     */
    public function testModificarTarjeta(){
        $conexion=new Conexion();
        $conexionUsar=$conexion->conectarBD($conexion);
        $tarjeta=new tarjeta();
        $tarjeta->setNumeroTarjeta(4711091651409485);
        $tarjeta->setCodigoVerificacion(556);
        $tarjeta->setFechaVencimiento('2026-09-01 00:00:00');
        ManejoTarjeta::setConexionBD($conexionUsar);
        ManejoTarjetaTest::assertEquals(ManejoTarjeta::modificarTarjeta($tarjeta),ManejoTarjeta::buscarTarjeta(4711091651409485));


    }




}


?>