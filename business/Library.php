<?php
/*
clase que representa a la entidad Library
*/
class Library{

    //-------------------------
    //Atributos
    //-------------------------
    /*
    Representa reservas
    */
    private $bookings;
    /*
    Representa devoluciones
    */
    private $returns;
    /*
    
    //----------------------------
    //Constructor
    //----------------------------
    /*
    Representa un constructor vacio para la clase Library
    */
    function __construct(){

    }
    /**
    * Método para obtener bookings
    * @return [array list] clave de acceso del bookings
    */
    public function getBookings(){
        return $this->bookings;
    }
    /**
    * Método para cambiar  bookings
    * @param [array list] clave de acceso del bookings
    */
    public function setBookings($bookings){
        $this->bookings = $bookings;
    }
    /**
    * Método para obtener  returns
    * @return [array list] clave de acceso del returns
    */
    public function getReturns(){
        return $this->returns;
    }
    /**
    * Método para cambiar  returns
    * @param [array list] clave de acceso del returns
    */
    public function setReturns($returns){
        $this->returns = $returns;
    }
    
}
?>