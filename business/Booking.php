<?php
/*
clase que representa a la entidad Usuario
*/
class Booking{

    //-------------------------
    //Atributos
    //-------------------------
    /*
    Representa la clave de acceso del booking
    */
    private $cod_booking;
    /*
    Representa codigo booking
    */
    private $cod_document;
    /*
    Representa el tipo del booking
    */
    private $type_document;
    /*
    Representa el available del booking: activo/inactivo
    */
    private $available;
    /*
    Representa el cod del Usuario
    */
    private $cod_user;
    //----------------------------
    //Constructor
    //----------------------------
    /*
    Representa un constructor vacio para la clase Usuario
    */
    function __construct(){

    }
    /**
    * Método para obtener la clave de acceso del Usuario
    * @return [String] clave de acceso del Usuario
    */
    public function getCod_booking(){
        return $this->cod_booking;
    }
    /**
    * Método para cambiar la clave de acceso del Usuario
    * @param [String] clave de acceso del Usuario
    */
    public function setCod_booking($cod_booking){
        $this->cod_booking = $cod_booking;
    }
    /**
    * Método para obtener la clave de acceso del Usuario
    * @return [String] clave de acceso del Usuario
    */
    public function getCod_document(){
        return $this->cod_document;
    }
    /**
    * Método para cambiar la clave de acceso del Usuario
    * @param [String] clave de acceso del Usuario
    */
    public function setCod_document($cod_document){
        $this->cod_document = $cod_document;
    }
    /**
     * Método para obtener el correo electronico del Usuario
     * @return [String] correo del Usuario
    */
    public function getType_document(){
        return $this->type_document;
    }
    /**
     * Método para obtener el correo electronico del Usuario
     * @param [String] correo del Usuario
     */
    public function setType_document($type_document){
        $this->type_document = $type_document;
    }
    /**
     * Método para obtener el status del Usuario (1:Activo/0:Inactivo)
     * @return [integer] status del Usuario
     */
    public function getAvailable(){
        return $this->available;
    }
    /**
     * Método para cambiar el available del Usuario 
    * @param [integer] available del Usuario
    */
    public function setAvailable($available){
        $this->available = $available;
    }
    /**
     * Método para obtener  el name del Usuario
     * @return [String] name del Usuario
     */
    public function getCod_user(){
        return $this->cod_user;
    }
    /**
     * Método para cambiar  el cod_user del Usuario
    * @param [String] cod_user del Usuario
    */
    public function setCod_user($cod_user){
        $this->cod_user = $cod_user;
    }
}
?>